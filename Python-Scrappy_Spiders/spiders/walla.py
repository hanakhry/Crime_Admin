# -*- coding: utf-8 -*-
import scrapy
from bs4 import BeautifulSoup
import requests
import json


class WallaSpider(scrapy.Spider):
    name = 'walla'
    allowed_domains = ['tags.walla.co.il', 'news.walla.co.il']
    start_urls = ['http://tags.walla.co.il/רצח']

    def parse(self, response):

        links = response.css('.row a::attr(href)').extract()

        for link in links:
            if 'https://news.walla.co.il/item/' in link:
                yield scrapy.http.Request(link, callback=self.parse_article)

        next_page = response.css('a[rel=next]::attr(href)').extract()[0]
        # print('#' * 50)
        if next_page:
            yield scrapy.Request(response.urljoin(next_page), callback=self.parse)

    def parse_article(self, response):
        # r = requests.get(link)
        soup = BeautifulSoup(response.text, 'html.parser')
        title = soup.find('h1', attrs={'class': 'title'})
        if title:
            title = title.text.replace(';', ',')
        tag = soup.find('section', attrs={'class': 'tags'})
        tags = []
        if tag:
            tag = tag.findAll('a')
            for a in tag:
                tags.append(a.text)
            tags = ','.join(tags)
        subtitle = soup.find('p', attrs={'class': 'subtitle'})
        if subtitle:
            subtitle = subtitle.text
        time = soup.find('time')
        if time:
            time = time['datetime']
        # time_heb = soup.find('time').text

        soup.find('p', attrs={'class': 'subtitle'}).extract()
        article_texts = soup.findAll('p')
        article = []
        for paragraph in article_texts:
            if paragraph.text == '':
                continue
            a = paragraph.find('section', attrs={'class': 'additional-links'})
            if a:
                a.extract()
            else:
                app = paragraph.text.split('עוד בוואלה')[0].strip()
                if app == '':
                    continue
                else:
                    if app[-1] != '.':
                        app += '.'
                    article.append(app)

        article = ' '.join(article)

        yield {'title': title, 'time': time, 'tags': tags,
               'subtitle': subtitle, 'article': article, 'link': response.url}
