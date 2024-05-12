const VNGeoAPI = "https://provinces.open-api.vn/api";
const fetchProvinceURL = `${VNGeoAPI}/p`;
const provinceCount = 63;

function initOptionNode(name, value) {
  const selectNode = document.createElement("option");
  selectNode.value = value;
  selectNode.innerText = name;
  return selectNode;
}

const selectProvince = document.getElementById("user-info__select-province");


fetch(`${VNGeoAPI}/?depth=2`, {
  method: "GET",
  mode: "cors",
})
  .then((response) => response.json())
  .then((data) => {
    // console.log(data);
    for (const province of data) {
    //   console.log(province.code);
      selectProvince.appendChild(initOptionNode(province.name, province.code));
    }
  });

document
  .getElementById("user-info__select-province")
  .addEventListener("change", () => {
    let selectNode = document.getElementById("user-info__select-province");
    let selectDistrict = document.getElementById("user-info__select-district");
    let code = selectNode.options[selectNode.selectedIndex].value;
    console.log(`${fetchProvinceURL}/${code}?depth=2`);
    fetch(`${fetchProvinceURL}/${code}?depth=2`)
      .then((response) => response.json())
      .then((data) => {
        let districts = data.districts;
        // console.log(districts);
        selectDistrict.innerHTML = "";
        selectDistrict.appendChild(initOptionNode("Chọn quận/huyện", ""));
        for (const district of districts) {
          selectDistrict.appendChild(
            initOptionNode(district.name, district.code)
          );
        }
        selectDistrict.value = "";
      });
  });


function checkout_complete(user_id) {
    // Assuming you have a <select> element with the id "mySelect"
    let provinceNode = document.getElementById("user-info__select-province");
    let districtNode = document.getElementById("user-info__select-district");

    // Get the selected option
    let prov = provinceNode.options[provinceNode.selectedIndex].innerText;
    let distr = districtNode.options[districtNode.selectedIndex].innerText;
    let fullName = document.getElementById('full-name').value;
    let phoneNumber = document.getElementById('phone-number').value;
    let addr = document.getElementById('address').value;
    let paymentMethod = document.querySelector('input[name="payment-method"]:checked').value;

    payload = {
        "user_id": user_id,
        province: prov,
        district: distr,
        full_name: fullName,
        phone_number: phoneNumber,
        address: addr,
        payment: paymentMethod
    }

    console.log(payload);

    fetch('checkout.php', {
        method: 'POST',
        cors: true,
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(payload)
    }).then((res) => {
        if (res.status == 200) {
            var successModal = document.getElementById("checkout-success");
            successModal.style.display = "block";
        } else 
            var failModal = document.getElementById("checkout-failed");
            failModel.style.display = "block";
        }
    )
}

