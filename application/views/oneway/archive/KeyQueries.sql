

// Insert New or missing locations into locations table
INSERT INTO locations( LocationID, Country, Province, City ) 
SELECT DISTINCT NULL , Country, Province, City, District
FROM locationsaps A
WHERE NOT EXISTS (
   SELECT 1 FROM locations L
   WHERE A.Country = L.Country 
   AND A.City = L.City
   WHERE A.Province = L.Province 
   AND A.District = L.District
)

// Proper Case
UPDATE locations set province =
CONCAT(UCASE(SUBSTRING(`province`, 1, 1)),LOWER(SUBSTRING(`province`, 2)))

// Load Members matching locations into Contacts
Insert into contacts (MemberID, LocationID) 
select Distinct 94, L.LocationID 
from locations L, locationsparks P
where L.Country = P.Country and L.City = P.City
and L.Province = P.Province and L.District = P.District

Update amitychurches A, locations L set A.LocationID = L.LocationID
where  L.City = A.City
and L.Province = A.Province and L.District is null