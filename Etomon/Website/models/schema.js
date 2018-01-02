//Require Mongoose
var mongoose = require('mongoose');

//Define a schema
var Schema = mongoose.Schema;

var UserInfo = new Schema({
    _id:String,
    Name:{type: String,required: true},
    Type:{type: String, enum:['Teacher','Student']}
    Email:{type: String, unique:true,required: true},
    PhoneNumber:{type: String, unique:true,required: true},
    PasswordsHash: String,
    Gender: {type:String,enum:['Male','Female','Other']},
    DayOfBirth: Date,
    Age: {type:Number,min:0},
    SelfIntro: String,
    ImgUrl: String,
    LivingPlace : String,
    Courses:[String]
});

var CourseInfo = new Schema({
    CourseName:{type: String, required: true},
    CourseID:{type: String, unique:true, required: true},
    Teacher:String,
    CourseDescription:{type: String, required: true},
    ImgUrl:String,
    CourseLink:String,
    CourseFee:Number,
    CourseTime:[{
      StartTime:Date,
      EndTime:Date
    }],
    Rating:{type:Number, min:0}
    });

var CourseAssignment = new Schema({
    CourseID:{type: String, required: true,unique:true},
    AssignmentID:{type: String, required: true,unique:true},
    StudentGrade:[{
      StudentName:String,
      StudentID:{type: String, required: true,unique:true},
      Grade:Number
    }]
    })

var CourseEnrolled = new Schema({
    Enrolled:{[
      CourseID:{type: String, unique:true, required: true},
      UserID:{type: String, unique:true, required: true}
    ]}
})

var Message = new Schema({
  SenderID:String,
  RecevierID:String,
  Content:String,
  SendDate:Date
})
