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

for item in tv_feed.entries:
    new_title = item.title.replace("Ç", "C")
    new_title = new_title.replace("À", "A")
    new_title = new_title.replace('Ô', 'O')
    new_title = new_title.replace('É', 'E')
    title_split = new_title.encode('utf-8').decode('latin1').split("|")

    new_sumamry = item.summary.replace("Ç", "C")
    new_sumamry = new_sumamry.replace("À", "A")
    new_sumamry = new_sumamry.replace('Ô', 'O')
    new_sumamry = new_sumamry.replace('É', 'E')

    print("{} :: {} :: {} :: {} :: {}".format(
        title_split[0],
        title_split[1],
        title_split[2],
        item.tags[0].term.encode('utf-8').decode('latin1'),
        new_sumamry.encode('utf-8').decode('latin1')
        )
    )   