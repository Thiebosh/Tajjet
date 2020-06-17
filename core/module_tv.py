# -*- coding: utf-8 -*-

import feedparser
from datetime import date

today = date.today()

if today.day < 10:
    day = "0" + str(today.day)
else:
    day = today.day

if today.month < 10:
    month = "0" + str(today.month)
else:
    month = today.month


tv_feed = feedparser.parse('https://webnext.fr/templates/webnext_exclusive/views/includes/epg_cache/programme-tv-rss_{}-{}-2020.xml'.format(day, month))

if (len(tv_feed.entries) == 0) :
    print(1)
else :
    print(0)

for item in tv_feed.entries:
    title_split = item.title.split("|")

    print("{} :: {} :: {} :: {} :: {}".format(
        title_split[0],
        title_split[1],
        title_split[2],
        item.tags[0].term,
        item.summary
        )
    )   