# TUNE Coding Challenge
user-dashboard-app

## The Task

A simple Users Dashboard developed using *`Laravel PHP`*. based on provided prototyping. following files used for data.
* `users.json`
* `logs.json`

## User Interface
I followed provided mockup as a guide. but desing can be improved more:

* Each card have the user's avatar, name, and occupation. For users with no image avatar, displayed the first letter of their first name in place of an image.

* Each card displayed the sum of all impressions, conversions, and revenue.

* Each card displayed a simple chart of conversions per day.

## Data

Two sets of mock data are used that represent 30 days of impressions, conversions, and revenue, as well as the user accounts associated with the activity.

`users.json`: An array of user objects. Each user may have an id, name, avatar, and occupation.

`logs.json`: Event information about the traffic. Each item has a type (either 'impression' or 'conversion'), date and time of the event, user ID of the account the event is related to, and any revenue associated.

## Application Design

In future a database as the source of information for users and logs can be used, though it is not currently implemented, so I take that into account in the design of solution just we have to change data source in controler.

In future also can be build additional views of users and event stats.

## Bonus Items

* Implemented the ability for the user to sort the cards by 
1. Sort By Name ASC
2. Sort By Impression ASC
3. Sort By Conversion ASC
4. Sort By Revenue ASC

* Write unit tests for testable portions of your code
1. User with no avatar `*Bailey G. Brazenor*` displayed the first letter of his first name in place of an image.
2. User with avatar in case of S3 permession display default avatar from storage.

