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
Text Extraction Algorithm:
Text Extraction
  Text extraction is done with PHP code. The found data such as the author, year, publication, are extracted and saved in MYSQL database. Text extraction is implemented on the results that are brought from Solr. The extracted data are the title of the research, the author name/s, the abstract if exists, the references of the research and the URL of the research. The extracted data is saved in the Citation Indexing dataset to form the Arabic Citation Indexing dataset. Text extraction is done as follows: 
1.	For each document brought from Solr check if it is written in Arabic language, if yes proceed otherwise discard this document.
2.	For each Arabic document check that it has at least three from the following terms “ ("المراجع" ,"ملخص الدراسة" ,"إعداد" , "عنوان البحث" , "موضوع البحث")(Abstract, prepared by, title of research, subject of research, references). The aim here is to ensure that it is a scientific research. If yes, proceed. Otherwise, discard this document. 
3.	In this step, we need to get the abstract, the title of the research, the author name, the references and the URL of this Arabic scientific research. For the collected data, we found that there is no standards for writing the Arabic researches that the authors stick to. This made the extraction process almost impossible. To solve this problem, the collected data is modified manually to put definite terms before and after every important section that is needed to be extracted. These terms are considered the standards we need to apply on each Arabic research to be able to create the Arabic Citation Indexing dataset. These standards are:
a)	The title of the research is to be proceeded by “عنوان البحث” and followed by “إعداد”.
b)	The abstract is to be proceeded by “ملخص الرسالة باللغة العربية” and followed by “Abstract”
c)	The name of the author is to be proceeded by “إعداد” and followed by “إشراف”
d)	The references section is to be proceeded by “قائمة المراجع” 
4.	Now the needed data is extracted and classified. Extra dots, semicolons and colons are deleted from the extracted data. 
5.	The name of the author is processed to get the first name, middle name and the last name. Then, the title, abstract, URL is to be stored in the articles table in the database. The first name, middle initial and the last name of the author is stored in the authors table in the database. 
6.	For the references section, each reference is proceeded to extract the author name/s and the title of the research. It was a complicated process that has the following steps:
a)	The text before the first dot is the author/s name. If it has the word “أخرون”, delete it. If it has“و”, it means there is more than one author. The words before “و” is a name and after it is another name. Get the names and proceed. If it doesn’t have a “ و” get the name and proceed
b)	In each name, check it has “,”. If yes, the word before it is the last name and after it the first name and the middle name. If the name doesn’t have a “,”, then count the spaces. If they are three spaces, then the word before the first space is the first name, the word before the second space is the middle name and the word before the third space is the last name. If it has two spaces, then the word before the first space is the first name and the word before the second space is the last name. If it has only one space, then the word before it is the last name. 
c)	For each reference, store the title of the research in the articles table. In this case the URL and the abstract of this article are empty. Store the author name/s in the author table and add a record in the citation table which has the ID of the original reference as the sourceId and the id of the reference as the referenceID
7.	Before storing any data the needed validation for duplicate records are done to be sure that each scientific research is stored only once and has a unique ID. 
8.	Each time a query is run, this whole process is repeated. If the article is stored before, the abstract and the URL is checked if they are empty. If yes and the extracted data has a URL and an abstract, which means that this article is stored before as a reference but now we got it as a whole article, then the URL and the abstract are updated. Besides, the references of it is processed as mentioned above and the references of it are added in the articles, authors and citation tables. 
Index.php is the file that contains the code that accomplish all of the above tasks. 
