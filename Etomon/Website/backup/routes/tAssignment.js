var express = require('express');
var router = express.Router();

/* GET home page. */

router.get('/', function(req, res,next) {
	console.log('Profile router');
	courseName = 'IEEE001';
  assignmentName = "Assignment01";
	assignments=[{
    studentName:'AKA'
    ,studentID:'whoKnows'
    ,url:'#'
    ,score:99
	}
  ,{
    studentName:'AKB'
    ,studentID:'sdasdsd'
    ,url:'#'
    ,score:1
  }
  ,{
    studentName:'AC'
    ,studentID:'sdasdsc'
    ,url:'#'
    ,score:50
  }
];
	res.render('tAssignment', {courseName,assignmentName,assignments});
});

module.exports = router;
