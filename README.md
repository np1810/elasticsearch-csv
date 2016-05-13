# ElasticSearch Pincode w/ PHP API
---

This application imports Indian Pincode's CSV to Elasticsearch using Logstash, uses Elasticsearch as data storage along with elasticsearch PHP API.

### An Pincode API end-point / route for searching / filtering the data set on parameters like -
- district
- state
- pincode

### Examples -
1. api.pinsearch.com/search?district=xxxx
2. api.pinsearch.com/search?district=xxxx&state=xxxx
3. api.pinsearch.com/search?q=xxxx (where you can pass any string to q, and if the string is present in any of the fields (i.e district, state etc) the api will return results.)

## Requirements

* Elasticsearch (ofcourse :P )
* Some CSV Data (e.g. Indian PIN Data )
* Logstash and it's *.conf file (for importing data)
* Apache2, PHP5.5, php5-curl (all these can be installed using APT)

## Installation

* Current config - Single Node, 3 Shards, 0 Replicas

* Clone the repo on your local computer.

* Extract **elasticsearch\*.tar.gz**

```sh
$ tar -xvf 'elasticsearch*.tar.gz'
```

* Replace **elasticsearch\*/config/elasticsearch.yaml** with the one inside this repo or with your own configurations.

* Change _MAX LIMITS (Maximum Number of File Descriptors)_ in **/etc/security/limits.conf** to -

```sh
* soft nofile 65537 # ( i.e. all_users soft_limit max_open_files 65537 )
* hard nofile 65537 # ( i.e. all_users hard_limit max_open_files 65537 )
```

* Paste the below line in two files **/etc/pam.d/common-session** and **/etc/pam.d/common-session-noninteractive**

```sh
session required pam_limits.so
```

* ##### RESTART YOUR PC!

* Verify new limits by -

```sh
$ ulimits -n
$ ulimits -Sn
$ ulimits -Hn
```

* To your **~/.bashrc** file  _(present in /home/user/)_, append the following (you can customize the values) -

```sh
export ES_HEAP_SIZE=1G # ElasticSearch Heap Size ( -Xms, -Xmz )
export MAX_OPEN_FILES=65537 # Max open files by ES
export LS_HEAP_SIZE=512M # LogsTash Heap Size
```

* Now run the **ElasticSearch** by -

```sh
cd /path/to/ElasticSearch
sh bin/elasticsearch
```

* Creating a new index named "data" in your nodes.

```
curl -XPUT localhost:9200/data

* Extract **logstash\*.tar.gz**

```sh
$ tar -xvf 'logstash*.tar.gz'
```

* Use it as it is or customize **importPincodeCsv.conf**

* Ensure **ElasticSearch** is running before you excute below commands -

```sh
$ /path/to/logstash/bin/logstash -f importPincodeCsv.conf --configtest
$ /path/to/logstash/bin/logstash -f importPincodeCsv.conf 
```

* Copy **web/** folder to your APACHE directory like **/var/www/html/**

* Change **Index Name, Type or URL:Port in the API** (if required)

* Open the web api... (Use POSTMAN or cURL for testing)

* This API has a **PRETTY** property as well - _**../search?pretty&q=value**_ 

## Contributing
Changes and improvements are more than welcome! Feel free to fork and open a pull request.
-- [Nitin Pathak](http://nitinpathak.com)

## License
Repo is licensed under the [MIT License](https://github.com/np1810/2048undo/blob/master/LICENSE.txt)

## Donations
If you would like to donate then [Donate to UNICEF](http://supportunicef.org)


