/*eslint-disable react/no-danger */
import React, { Component } from "react";
import PropTypes from "prop-types";
import styled from "styled-components";
import { color, space, hover } from "styled-system";
import cx from "classnames";
import { color as c } from "metabase/lib/colors";

import { loadIcon } from "metabase/icon_paths";
import { stripLayoutProps } from "metabase/lib/utils";

import Tooltipify from "metabase/hoc/Tooltipify";

export const IconWrapper = styled("div")`
  ${space};
  display: flex;
  align-items: center;
  justify-content: center;
  width: 40px;
  height: 40px;
  border-radius: 99px;
  cursor: pointer;
  color: ${props => (props.open ? c("brand") : "inherit")};
  // special cases for certain icons
  // Icon-share has a taller viewvbox than most so to optically center
  // the icon we need to translate it upwards
  "> .icon.icon-share": {
    transform: translateY(-2px);
  }
  ${hover};
  transition: all 300ms ease-in-out;
`;

IconWrapper.defaultProps = {
  hover: {
    backgroundColor: c("bg-medium"),
    color: c("brand"),
  },
};

const stringOrNumberPropType = PropTypes.oneOfType([
  PropTypes.number,
  PropTypes.string,
]);

export const iconPropTypes = {
  name: PropTypes.string.isRequired,
  size: stringOrNumberPropType,
  width: stringOrNumberPropType,
  height: stringOrNumberPropType,
  scale: stringOrNumberPropType,
  tooltip: PropTypes.string,
  defaultName: PropTypes.string,
  className: PropTypes.string,
};

const defaultProps = {
  defaultName: "unknown",
};

class BaseIcon extends Component {
  render() {
    const { name, defaultName, className, ...rest } = this.props;

    const icon = loadIcon(name) || loadIcon(defaultName);
    if (!icon) {
      console.warn(`Icon "${name}" does not exist.`);
      return <span />;
    }

    const props = {
      ...icon.attrs,
      ...stripLayoutProps(rest),
      className: cx(icon.attrs.className, className),
    };

    for (const prop of ["width", "height", "size", "scale"]) {
      if (typeof props[prop] === "string") {
        props[prop] = parseInt(props[prop], 10);
      }
    }
    if (props.size != null) {
      props.width = props.size;
      props.height = props.size;
    }
    if (props.scale != null && props.width != null && props.height != null) {
      props.width *= props.scale;
      props.height *= props.scale;
    }
    delete props.size, props.scale;

    if (icon.img) {
      // avoid passing `role="img"` to an actual image file
      // eslint-disable-next-line no-unused-vars
      const { role, ...rest } = props;
      return (
        <img
          src={icon.img}
          srcSet={`
          ${icon.img}    1x,
          ${icon.img_2x} 2x
        `}
          {...rest}
        />
      );
    } else if (icon.svg) {
      return <svg {...props} dangerouslySetInnerHTML={{ __html: icon.svg }} />;
    } else if (icon.path) {
      return (
        <svg {...props}>
          <path d={icon.path} />
        </svg>
      );
    } else {
      console.warn(`Icon "${name}" must have an img, svg, or path`);
      return <span />;
    }
  }
}

BaseIcon.propTypes = iconPropTypes;
BaseIcon.defaultProps = defaultProps;

const Icon = styled(BaseIcon)`
  ${space}
  ${color}
  ${hover}
  flex-shrink: 0
`;

export default Tooltipify(Icon);
