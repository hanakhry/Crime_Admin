/* eslint-disable react/prop-types */
import React from "react";

import { DragSource } from "react-dnd";
import { getEmptyImage } from "react-dnd-html5-backend";

import { dragTypeForItem } from ".";

@DragSource(
  props => dragTypeForItem(props.item),
  {
    canDrag({ isSelected, selected, collection, item }, monitor) {
      // can't drag if can't write the parent collection
      if (collection && collection.can_write === false) {
        return false;
      }

      return isSelected || selected.length === 0;
    },
    beginDrag(props, monitor, component) {
      return { item: props.item };
    },
    async endDrag({ selected, onDrop }, monitor, component) {
      if (!monitor.didDrop()) {
        return;
      }
      const { item } = monitor.getItem();
      const { collection, pinIndex } = monitor.getDropResult();
      if (item) {
        const items = selected && selected.length > 0 ? selected : [item];
        try {
          if (collection !== undefined) {
            await Promise.all(
              items.map(i => i.setCollection && i.setCollection(collection)),
            );
          } else if (pinIndex !== undefined) {
            await Promise.all(
              items.map(i => i.setPinned && i.setPinned(pinIndex)),
            );
          }

          onDrop && onDrop();
        } catch (e) {
          alert("There was a problem moving these items: " + e);
        }
      }
    },
  },
  (connect, monitor) => ({
    connectDragSource: connect.dragSource(),
    connectDragPreview: connect.dragPreview(),
    isDragging: monitor.isDragging(),
  }),
)
export default class ItemDragSource extends React.Component {
  componentDidMount() {
    // Use empty image as a drag preview so browsers don't draw it
    // and we can draw whatever we want on the custom drag layer instead.
    if (this.props.connectDragPreview) {
      this.props.connectDragPreview(getEmptyImage(), {
        // IE fallback: specify that we'd rather screenshot the node
        // when it already knows it's being dragged so we can hide it with CSS.
        captureDraggingState: true,
      });
    }
  }
  render() {
    const { connectDragSource, children, ...props } = this.props;
    return connectDragSource(
      // must be a native DOM element or use innerRef which appears to be broken
      // https://github.com/react-dnd/react-dnd/issues/1021
      // https://github.com/jxnblk/styled-system/pull/188
      typeof children === "function" ? children(props) : children,
    );
  }
}