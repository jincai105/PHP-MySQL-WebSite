var express = require('express');
var router = express.Router();

/* GET home page. */

router.get('/', function(req, res,next) {
	console.log('Profile router');
	courseName = 'IEEE001';
	enrolledStudentReviews=[{
    name:'AKA'
    ,studentID:'whoKnows'
    ,score:99
    ,review:'Great student!!'

	}
  ,{
    name:'AKB'
    ,studentID:'sdasdsd'
    ,score:1
    ,review:'Bad student!!'

  }
  ,{
    name:'AC'
    ,studentID:'sdasdsc'
    ,score:50
    ,review:`who's he?`

  }
];
	res.render('tReview', {courseName,enrolledStudentReviews});
});

module.exports = router;
