# Arabic-Citation-Indexing.
It is an Arabic citation indexing system using the latest technologies to offer efficient performance. 
It is based on Lucene , Solr and Nutch 
It is considered as a search engine for Arabic scientific researches. 
First of all, the user interface gets the user query and sends it to Solr. 
The query processing function in Solr sends the user query to the parser to process it word by word. 
Using the Indexing function the result is retrieved from the index database and is returned back to the parser.  
The parser sends the results to the citation extractor. 
The citation extractor first validate each article of the results is in Arabic language and is a research article. 
Then, it extracts the citation data which are the title of the article, the author’s/s’ name/s, the abstract and the references. 
The citation data is send to the citation database. 
The ranker gets the needed data from the citation indexing database and rank it based on the author who has the greatest number of articles related to the query or based on the number of citations of each article. 
The article that has the more citations is listed before the others. 
Finally, the result is shown on the user interface. 
The crawling process is repeated on regular basis to get the latest researches published on the internet. 
The crawling and the indexing process are done by Nutch and Solr which are based on Lucene. 
