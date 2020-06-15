import requests, atoma
 
response = requests.get('https://webnext.fr/templates/webnext_exclusive/views/includes/epg_cache/programme-tv-rss_09-06-2020.xml')
feed = atoma.parse_rss_bytes(response.content)
ret = []
for item in feed.items:
    ret.append(item.title)
    print(item.title)