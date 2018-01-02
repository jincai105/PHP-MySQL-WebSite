var express = require('express');
var router = express.Router();

/* GET home page. */

router.get('/', function(req, res,next) {
	console.log('Profile router');
	courseName = 'IEEE001';
	assignments=[{
    name:'Assignment01'
    ,grade:'A'
    ,tag:'IEEE001-assignment01'
		,url:'ass01'
	}
  ,{
    name:'Assignment02'
    ,grade:'B'
    ,tag:'IEEE001-assignment02'
		,url:'ass02'
  }
	,{
    name:'Middle Term'
    ,grade:'95'
    ,tag:'IEEE001-middleterm'
		,midterm:'middleterm'
  }
];
	res.render('sAssignment', {assignments,courseName});
});

module.exports = router;
