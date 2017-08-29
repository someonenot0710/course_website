function init(){
          $.ajax({
            url:"MessageBoard.php", //the page containing php script
            type: "POST", //request type,
            datatype: 'json',
            success:function(result){
//                console.log(result);
//                show(result);
		rank_thumb(result);
           }
    })
}

function getMessage () {
	
	var student_poi = document.getElementById('name');
	var datas_poi = document.getElementById('content');
	var student = student_poi.value;
	var datas = datas_poi.value;
	student_poi.value="";
	datas_poi.value="";	
	console.log(student+"  "+datas);	
          $.ajax({
            url:"MessageBoard.php", //the page containing php script
            type: "POST", //request type,
            datatype: 'json',
           data: {registration: "success", student_id: student, contents: datas},
            success:function(result){
//		console.log(result);
//		show(result);
		rank_thumb(result);
           }
    })
}


function saveData(){

}


function show(result){
var board = document.querySelector("#board");
var list = document.getElementsByClassName('one');
//console.log(result[0]);
for(var i = list.length - 1; 0 <= i; i--)
 if(list[i] && list[i].parentElement)
 list[i].parentElement.removeChild(list[i]);


for (i=0;i<result.length;i++){
	para = document.createElement("div");
	u = document.createElement("h1");
	t = document.createElement("h1");
	c = document.createElement("h1");
	thumb = document.createElement("button");
	thumb_num = document.createElement("p");
	u_con = document.createTextNode(result[i]['username']);
	t_con = document.createTextNode(result[i]['times']);
	c_con = document.createTextNode(result[i]['contents']);		
	thumb_con = document.createTextNode("讚");
	thumb_num_con = document.createTextNode(result[i]['thumbs']);
	thumb.className = result[i]['id'];
	thumb_num.id = result[i]['id'];
	thumb.setAttribute( "onClick", "press_thumb(this.className)" );
	u.appendChild(u_con);
	t.appendChild(t_con);
	c.appendChild(c_con);
	thumb.appendChild(thumb_con);
	thumb_num.appendChild(thumb_num_con);
	
	para.appendChild(u);
	para.appendChild(t);
	para.appendChild(c);
	para.appendChild(thumb);
	para.appendChild(thumb_num);
	para.className+= 'one';	
//	para.id = result[i]['id'];
	board.appendChild(para);
}

}
function rank_thumb(result){

//result.sort(function(a,b) {return (parseInt(a.thumbs) < parseInt(b.thumbs)) ? 1 : ((parseInt(b.thumbs) > parseInt(a.thumbs)) ? -1 : 0);} );
result.sort(compare);
//console.log(result);

show(result);

}


function compare(a,b) {
  if (parseInt(a.thumbs) < parseInt(b.thumbs))
    return 1;
  if (parseInt(a.thumbs) > parseInt(b.thumbs))
    return -1;
  return 0;
}


function press_thumb(class_name){

var num = document.getElementById(class_name);

count = parseInt(num.innerHTML);
count = count+1;

num.innerHTML = count;

save_thumb(class_name,count);

}


function save_thumb(m_id,m_num){
 
         $.ajax({
            url:"MessageBoard.php", //the page containing php script
            type: "POST", //request type,
            datatype: 'json',
           data: {registration: "thumb", para_id: m_id, para_thumb: m_num},
            success:function(result){
 //            console.log(result);
               // show(result);
		rank_thumb(result);
           }
    })
}


window.onload = function(){
init();
}
