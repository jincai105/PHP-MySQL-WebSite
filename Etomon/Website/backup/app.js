var express = require('express')
	, stylus = require('stylus')
	, nib = require('nib');
var path = require('path');
var favicon = require('serve-favicon');
var logger = require('morgan');
var cookieParser = require('cookie-parser');
var bodyParser = require('body-parser');
var app = express();


// view engine setup
function compile(str, path) {
  return stylus(str)
    .set('filename', path)
    .use(nib())
}
app.set('views', path.join(__dirname, 'views'));
app.set('view engine', 'ejs');

var index = require('./routes/index');
var users = require('./routes/users');
var classElement = require('./routes/classelement');
var profile = require('./routes/profile');
var studentCourses = require('./routes/studentCourses');
var studentSingleCourse = require('./routes/studentSingleCourse');
var sAssignment = require('./routes/sAssignment');
var sReview = require('./routes/sReview');
var tReview = require('./routes/tReview');
var tAssignment = require('./routes/tAssignment');
// uncomment after placing your favicon in /public
//app.use(favicon(path.join(__dirname, 'public', 'favicon.ico')));
app.use(logger('dev'));
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: true }));
app.use(cookieParser());

app.use(stylus.middleware(
  {        src: __dirname + '/public'
   , compile: compile  }
));

//console.log( ' '+  __dirname + '/public');
app.use(express.static(path.join(__dirname, '/public')));

app.use('/', classElement);
app.use('/users', users);
app.use('/class',classElement);
app.use('/profile',profile);
app.use('/studentcourses',studentCourses);
app.use('/studentsinglecourse',studentSingleCourse);
app.use('/sassignment',sAssignment);
app.use('/sReview',sReview);
app.use('/tReview',tReview);
app.use('/tassignment',tAssignment);
// catch 404 and forward to error handler
app.use(function(req, res, next) {
  var err = new Error('Not Found');
  err.status = 404;
  next(err);
});



// error handler
/*
app.use(function(err, req, res, next) {
  // set locals, only providing error in development
  res.locals.message = err.message;
  res.locals.error = req.app.get('env') === 'development' ? err : {};

  // render the error page
  res.status(err.status || 500);
  res.render('error');
});*/

module.exports = app;
