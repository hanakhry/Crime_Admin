# -*- coding: utf-8 -*-
import scrapy
import requests
from bs4 import BeautifulSoup
import json


class YnetSpider(scrapy.Spider):
    name = 'ynet'
    allowed_domains = ['www.ynet.co.il']
    start_urls = ['https://www.ynet.co.il/tags/רצח']
    # start_urls = ['https://www.ynet.co.il/tags/0,7340,L-8167-1949-1,00.html']

    def parse(self, response):
        # titles = response.css('.smallheader::text').extract()
        links = response.css('.smallheader::attr(href)').extract()

        for link in links:
            if '/articles/' in link:
                r = requests.get('https://www.ynet.co.il'+link)
                soup = BeautifulSoup(r.text, "html.parser")
                ld = soup.find('script', type="application/ld+json")
                ld_json = json.loads(ld.text)
                yield ld_json


        # NEXT_PAGE_SELECTOR = '.next a ::attr(href)'
        next_page = response.css('a.smallheader.HeadlineNext::attr(href)').extract()[0]
        print('#'*50)
        print(next_page)
        if next_page:
            yield scrapy.Request(
                response.urljoin(next_page),
                callback=self.parse
            )
