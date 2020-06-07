import requests

response = requests.get('https://webnext.fr/templates/webnext_exclusive/views/includes/epg_cache/programme-tv-rss_07-06-2020.xml')
print(response.content)
