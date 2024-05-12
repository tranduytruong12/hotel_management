function displayAvatarFromInputLink(val, elementId) {
    const selectedImage = document.getElementById(elementId);
    if (val == '') {
        val = "https://mdbootstrap.com/img/Photos/Others/placeholder.jpg";
    }
    selectedImage.src = val;

}

function resetDisplayAvatar(elementClass) {
    const collection = document.getElementsByClassName(elementClass);
    for (let i = 0; i < collection.length; i++) {
        collection[i].src = "https://mdbootstrap.com/img/Photos/Others/placeholder.jpg";
    }

}

function checkInputValue(formId){
    const formE = document.getElementById(formId);
    const inputPrice = formE.getElementById('price');
    if (inputPrice.value > 1000000000000){
        alert("Giá tiền quá lớn.");
        return false;
    }

    return true;
}

function capitalizeFirstLetter(str) {
    return str.charAt(0).toUpperCase() + str.slice(1);
}

function onUpdateInfoElement(iputElementId){
    const inputE = document.getElementById(iputElementId);
    inputE.name = 'update' + capitalizeFirstLetter(iputElementId);
}

function resetUpdateInfoElement(formId){
    const formE = document.getElementById(formId);
    const collectionInput = formE.getElementsByTagName('input');
    for (let i = 0; i < collectionInput.length; i++) {
        collectionInput[i].name = 'unUpdate' + capitalizeFirstLetter(collectionInput[i].id);
    }

    const collectionTextarea = formE.getElementsByTagName('textarea');
    for (let i = 0; i < collectionTextarea.length; i++) {
        collectionTextarea[i].name = 'unUpdate' + capitalizeFirstLetter(collectionTextarea[i].id);
    }

    resetDisplayAvatar('selectedAvatarClass');
}

function ajaxCategorySelection(val) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("categoryid").innerHTML = this.responseText;
        }
    };
    xmlhttp.open("POST", "../controller/controller.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send('valueCustomerTypeSelected=' + val);
}





function trigger_disable_button_id(btnId) {
    var btn = document.querySelector(`#${btnId}`);

    if (btn.getAttribute('disabled') != null) {
        btn.setAttribute('disabled', 'disabled');
        return;
    } else {
        btn.removeAttribute('disabled');
        return;
    }
}


function confirmSubmitRemoveProduct(product_id, form_name) {

    var conf = confirm(`Bạn muốn xoá xản phẩm này! (mã sản phẩm: ${product_id})`);

    if (conf == true) {
        var form = document.querySelector(`#${form_name}`);

        var inputElement = form.querySelector('#inputIdOfProductRemoved');

        inputElement.value = product_id;

        return true;
    } else {
        return false;
    }

}

function infoModalEditCategory(category_id, object, category_name){
    const formE = document.getElementById('formForEditCategory');
    const inputObj = document.getElementById('editedObject');
    const inputCategory = document.getElementById('editCategory');

    inputObj.value = object;
    inputCategory.value = category_name;
    formE.action = formE.action + category_id;
}

function infoFormDeleteCategory(category_id){
    const formE = document.getElementById('formForDeleteCategory');
    const inputCategoryId = document.getElementById('deleteCategoryId');
    inputCategoryId.value = category_id;
}
