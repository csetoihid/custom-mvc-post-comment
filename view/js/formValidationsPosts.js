
function validation() {
        var isValid = 1;
        var content  = document.getElementById('content').value;
        var title = document.savePost.title.value;
        var contentCount = content.replace(/^\s+|\s+$/g,'');
       
    if(validTitle(title) === 0){return false;}
    else if(validContent(content,contentCount) === 0){return false;}
    else{return true;}
}
    function validTitle(title){
        var number = title.match(/\d+/g);
        if (title ==='') {
            document.getElementById("validationTitle").innerHTML = 'Please provide title of the post!';
            return 0;
        }else if (number !== null) {
            document.getElementById("validationTitle").innerHTML = 'Title should not be contain number';
            return 0;
        }else{
            document.getElementById("validationTitle").innerHTML = '';
            return 1;            
        }
    }
    function validContent(content,contentCount){
        var res =  content.match(/<(?=.*? .*?\/ ?>|br|hr|input|!--|wbr)[a-z]+.*?>|<([a-z]+).*?<\/\1>/);
        if (contentCount =='') {
            document.getElementById("validationContent").innerHTML = 'Please provide title of the post!';
            return 0;
        }else if (res != null) {
            document.getElementById("validationContent").innerHTML = 'Title should not be contain html tags';
            return 0;
        }else{
            document.getElementById("validationContent").innerHTML = '';
            return 1;            
        }
    }
    
