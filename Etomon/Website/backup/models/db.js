var MongoClient = require('mongodb').MongoClient;
var url="mongodb://localhost:27017/";

var insertData = function(db,callback){
    
    var collection = db.collection('class');

    var data = [{"name":"newbee","url":"ww.test.com"},{"name":"lee","url":"lee.com"}];

    collection.insert(data,function(err,result){
        if(err){
            console.log('Error:'+err);
            return;
        }
        callback(result);

    });
}

var selectData = function(db,callback){
    
    var collection = db.collection('site');

    var whereStr ={"name":"newbee"};
    
    collection.find(whereStr).toArray(function(err,result){
        if(err)
        {
            console.log("Error:"+err);
            return;
        }
        callback(result);
    });
}

var updateData = function(db, callback) {  
    //连接到表  
    var collection = db.collection('site');
    //更新数据
    var whereStr = {"name":"newbee"};
    var updateStr = {$set: { "url" : "https://www.runoob.com" }};
    collection.update(whereStr,updateStr, function(err, result) {
        if(err)
        {
            console.log('Error:'+ err);
            return;
        }     
        callback(result);
    });
}
 
var delData = function(db, callback) {  
  //连接到表  
  var collection = db.collection('site');
  //删除数据
  var whereStr = {"name":"newbee"};
  collection.remove(whereStr, function(err, result) {
    if(err)
    {
      console.log('Error:'+ err);
      return;
    }     
    callback(result);
  });
}

var creatClassCollection = function(db,callback){
    
    var collection = db.collection('class');

    var data = [
    {"_id":"F91","classname":"FFF", "teachername":"wang", "teacherid":"F92","teacherimg":"", "classdescription":"this is a f91 class", "classfee":"233", "classimg":"", "url":"ww.test.com", "numofstudent":91,"startdate":"05/23/2017","enddate":"06/23/2018","classtimelength":"2 Hours","classtime":["Wed 5pm","Mon 4:30am"],"classratingstar":5}
    , {"_id":"0087","classname":"DDD", "teachername":"lee", "teacherid":"M87","teacherimg":"", "classdescription":"this is a 0087 class", "classfee":"233", "classimg":"", "url":"ww.test2.com", "numofstudent":110,"startdate":"09/23/2017","enddate":"03/01/2018","classtimelength":"3 Hours","classtime":["Fri 5pm","Sun 4:30am"],"classratingstar":4}
    ];

    collection.insert(data,function(err,result){
        if(err){
            console.log('Error:'+err);
            return;
        }
        callback(result);

    });
}

var selectCollection = function(db,collectionName,whereStr,callback){
    
    var collection = db.collection(collectionName);

    //var whereStr ={"name":"newbee"};
    
    collection.find(whereStr).toArray(function(err,result){
        if(err)
        {
            console.log("Error:"+err);
            return;
        }
        callback(result);
    });
    
}
 
MongoClient.connect(url,function(err,db){
    if(err) throw err;
    var dbase = db.db("testdb");
    console.log("database connected");
    /*
    dbase.createCollection("runoob",function(err,res){
        if(err) throw err;
        console.log("collection create");
        db.close()
    });
    insertData(dbase,function(result){
        console.log(result);
        db.close();
    });
    selectData(dbase,function(result){
        console.log(result);
        db.close();
    });
    updateData(dbase,function(result){
        console.log(result);
        db.close();
    });
    delData(dbase,function(result){
        console.log(result);
        db.close();
    });*/

    /*creatClassCollection(dbase,function(result){
        console.log(result);
        db.close();
    });*/
    //console.log(dbase.collection('class').find().toArray());
    //var result=[];
    selectCollection(dbase,'class',{"name":"FFF"},function(result){
        console.log(result);
        db.close();
    });
    /*
    dbase.collection('class').find().toArray(function(err,result){
        if(err)
        {
            console.log("Error:"+err);
            return;
        }
        console.log(result);
    });*/

    

});
