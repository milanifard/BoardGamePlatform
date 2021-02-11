function $(id){ return document.getElementById(id);}
selectCount = 0;
function select1(id) {
    var checkBox = $(id);

    if(checkBox.checked == true){
        if(selectCount<3){
            selectCount++;
        }
        else
        {
            checkBox.checked = false;
        }
    }
    else{
        if(selectCount > 0)
        {
            selectCount--;
        }
    }
}


// function function1()
// {
//     $("red")
// }
