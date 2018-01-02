var express = require('express');
var router = express.Router();

/* GET home page. */

router.get('/', function(req, res,next) {
	console.log('Profile router');
  courses=[{
    courseName : "IEEE001"
    ,url :"studentsinglecourse"
    ,imgurl:"https://placehold.it/150x80?text=IMAGE"
  }
  ,{
    courseName : "IEEE002"
    ,url :"studentsinglecourse"
    ,imgurl:"https://placehold.it/150x80?text=IMAGE"
  }
  ,{
    courseName : "IEEE003"
    ,url :"studentsinglecourse"
    ,imgurl:"https://placehold.it/150x80?text=IMAGE"
  }
  ,{
    courseName : "IEEE004"
    ,url :"studentsinglecourse"
    ,imgurl:"https://placehold.it/150x80?text=IMAGE"
  }
  ,{
    courseName : "IEEE005"
    ,url :"studentsinglecourse"
    ,imgurl:"https://a0.muscache.com/im/pictures/014e259a-8250-415c-9994-a2305125b83d.jpg?aki_policy=large"
  }];
	// user={
	// 	firstName : 'abc'
	// 	,lastName : 'def'
	// 	,phonenum : '9175171618'
	// 	,location : 'new york'
	// 	,email : 'etomon@gmail.com'
	// 	,sex : 'Other'
	// 	,dayOfBirth : '07/21/1992'
	// 	,userId : 'ACXADAD'
	// };
	//console.log(user.firstName);
	res.render('StudentCourses', courses);
});

module.exports = router;
