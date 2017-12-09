Done: 
Updated Visit object to include lastPing property. Visit.PHP should be fine now.

Updated VisitDB methods to include lastPing.

Updated SQL script to include last ping column

Updated sample SQL data and set last ping equal to start time

Added IF statement to verify that one row was inserted into visit table when visit object is created. Throw pdo exception otherwise.




To Do:

Test visit and visitDB

Add to controller something along the lines of if action=updatePing ...

add controller for ajax call to update last ping

write JS code to make an ajax call