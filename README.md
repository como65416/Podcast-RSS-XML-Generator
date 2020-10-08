# Podcast RSS XML Generator

### Example code

```php
use Comoco\PodcastRssXml\RssGenerator;
use Comoco\PodcastRssXml\Models\Item;

$rssGenerator = new RssGenerator;
$content = $rssGenerator->setTitle('Dafna\'s Zebra Podcast')
    ->setAuthor('Dafna')
    ->setOwner('dafna@example.com')
    ->setDescription('A pet-owner\'s guide to the popular striped equine.')
    ->setCategory('Pet & Hobbies')
    ->setImageUrl('https://www.example.com/podcasts/dafnas-zebras/img/dafna-zebra-pod-logo.jpg')
    ->setLanguage('en-us')
    ->setLink('https://www.example.com/podcasts/dafnas-zebras/')
    ->addItem(
        (new Item)->setTitle('Top 10 myths about caring for a zebra')
            ->setGuid('dzpodclean')
            ->setDescription('Here are the top 10 misunderstandings about the care, feeding, and breeding of these lovable striped animals.')
            ->setPubTime(1489492800)
            ->setAudioUrl('https://www.example.com/podcasts/dafnas-zebras/audio/toptenmyths.mp3')
            ->setAudioType('audio/mpeg')
            ->setAudioLength(26004388)
            ->setDuration(1368)
    )
    ->toXml();

echo $content . PHP_EOL;
```

### Output

```xml
<?xml version="1.0"?>
<rss version="2.0" xmlns:googleplay="http://www.google.com/schemas/play-podcasts/1.0" xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd">
 <channel>
  <title>Dafna's Zebra Podcast</title>
  <googleplay:author>Dafna</googleplay:author>
  <itunes:author>Dafna</itunes:author>
  <googleplay:owner>dafna@example.com</googleplay:owner>
  <itunes:owner>dafna@example.com</itunes:owner>
  <description>A pet-owner's guide to the popular striped equine.</description>
  <googleplay:description>A pet-owner's guide to the popular striped equine.</googleplay:description>
  <itunes:summary>A pet-owner's guide to the popular striped equine.</itunes:summary>
  <googleplay:category>Pet &amp; Hobbies</googleplay:category>
  <itunes:category>Pet &amp; Hobbies</itunes:category>
  <image>
   <link>https://www.example.com/podcasts/dafnas-zebras/img/dafna-zebra-pod-logo.jpg</link>
  </image>
  <googleplay:image href="https://www.example.com/podcasts/dafnas-zebras/img/dafna-zebra-pod-logo.jpg"/>
  <itunes:image href="https://www.example.com/podcasts/dafnas-zebras/img/dafna-zebra-pod-logo.jpg"/>
  <language>en-us</language>
  <link>https://www.example.com/podcasts/dafnas-zebras/</link>
  <item>
   <title>Top 10 myths about caring for a zebra</title>
   <description>Here are the top 10 misunderstandings about the care, feeding, and breeding of these lovable striped animals.</description>
   <googleplay:description>Here are the top 10 misunderstandings about the care, feeding, and breeding of these lovable striped animals.</googleplay:description>
   <itunes:summary>Here are the top 10 misunderstandings about the care, feeding, and breeding of these lovable striped animals.</itunes:summary>
   <guid isPermaLink="false">dzpodclean</guid>
   <pubDate>Tue, 14 Mar 2017 12:00:00 GMT</pubDate>
   <enclosure url="https://www.example.com/podcasts/dafnas-zebras/audio/toptenmyths.mp3" type="audio/mpeg" length="26004388"/>
  </item>
 </channel>
</rss>
```
