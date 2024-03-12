//registracija
let greske;
let greskelogin;
let genderData = [];
let categoryData = [];
let brandData = [];
let sortData;
let strana = 1;
let searchData;
let choicesData = [];

let next = $("#next");
let back = $("#back");

//Regex
let nameRegex = /^[A-Z][a-z]{2,14}$/;
let mailRegex = /^[A-z0-9-\.]{3,30}@[a-z]{2,8}\.(com|rs)$/;
let passwordRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/;
let addressRegex = /^[A-z]+[0-9]+$/;

$(document).ready(function () {
  //Registracija
  $(document).on("click", "#registerBtn", registracija);

  //Load products

  if (document.location.pathname.includes("shop.php")) {
    loadProducts();
    //Pages

    //Go on next page
    next.on("click", function () {
      strana++;
      localStorage.setItem("strana", strana);
      loadProducts();
    });

    //Go on previous page
    back.on("click", function () {
      strana--;
      if (strana < 1) {
        strana = 1;
      }
      localStorage.setItem("strana", strana);
      loadProducts();
    });

    //filter
    let genders = $(".gender");
    genders.on("change", function (e) {
      checkBoxValidator(e, genderData, "gender");
    });

    let brands = $(".brands");
    brands.on("change", function (e) {
      checkBoxValidator(e, brandData, "brand");
    });

    let categories = $(".category");
    categories.on("change", function (e) {
      checkBoxValidator(e, categoryData, "category");
    });

    // $(".editForma").on("submit", editForma);
    //Sort
    $("#ddlSort").on("change", function () {
      sortData = $(this).val();
      console.log(sortData);
      finallyFilter();
    });

    //Search

    let searchBtn = $(".searchBtn");
    searchBtn.on("click", function () {
      $(".modal").css("display", "block");
      $(".modal-backdrop").addClass("show");
      $("body").addClass("modal-open");
    });

    let search = $(".search");
    $(".submitSearch").on("click", function (e) {
      strana = 1;
      localStorage.setItem("strana", strana);
      searchData = search.val();

      finallyFilter();
      search.val("");
      $(".modal").css("display", "none");
      $(".modal-backdrop").removeClass();
      $("body").removeClass("modal-open");
      $("body").css("padding", "0");
    });
  }
});

//Add to cart

window.addEventListener("load", function () {
  if (document.location.pathname.includes("shop-single.php")) {
    let messageBlock = document.querySelector(".atc");
    let atcBtn = document.querySelector("#addToCart");
    let errors = document.querySelector("#errors");
    atcBtn.addEventListener("click", function (e) {
      e.preventDefault();
      messageBlock.innerHTML = "";

      let productCt = document.querySelector("#product-container");
      let userId = productCt.getAttribute("data-userID");
      let productId = productCt.getAttribute("data-id");
      let quantity = document.querySelector("#var-value").textContent;
      let size = document.querySelectorAll(".btn-size");
      let sizeId;
      size.forEach((btn) => {
        if (btn.classList.contains("btn-secondary")) {
          sizeId = btn.getAttribute("data-sizeID");
        }
      });

      if (sizeId == undefined) {
        errors.innerHTML =
          "<h3 class='h3 text-danger fw-bolder'>Choose size</h3>";
      } else {
        data = {
          productId: productId,
          quantity: quantity,
          sizeId: sizeId,
          userId: userId,
        };
        ajaxCallBack(
          "logic/addToCart.php",
          data,
          function (data) {
            console.log(data);
            messageBlock.innerHTML = `${data}`;
            messageBlock.classList.remove("atc-hidden");
            setTimeout(function () {
              messageBlock.classList.add("atc-hidden");
            }, 4000);
          },
          function (xhr) {
            console.log(xhr);
          }
        );
      }
    });

    //Rewiews
    let rewiewBtn = document.querySelector("#sendRewies");
    let courseContent = document.querySelector(".course-content");
    let productId = courseContent.getAttribute("data-product");
    console.log(productId);
    getRecension(productId);
    rewiewBtn.addEventListener("click", function (e) {
      e.preventDefault();
      let title = document.querySelector("#title").value;
      let message = document.querySelector("#message").value;
      let msgBlock = document.querySelector(".report");
      let userID = rewiewBtn.getAttribute("data-id");

      if (title == "" || message == "") {
        msgBlock.innerHTML = `<p class="alert alert-danger">You must fill in all fields</p>`;
        return;
      } else {
        msgBlock.innerHTML = "";
        data = {
          productId: productId,
          userId: userID,
          title: title,
          message: message,
        };
        ajaxCallBack(
          "logic/insertRewiew.php",
          data,
          function (data) {
            getRecension(productId);
          },
          function (xhr) {
            console.log(xhr);
          }
        );
      }
    });
  } else if (document.location.pathname.includes("cart.php")) {
    getProductForCart();
    let prodCt = document.querySelector(".cart-product-ct");
    let userid = document.querySelector("#user");
    let id = userid.getAttribute("data-id");
    let checkout = document.querySelector(".checkout");

    checkout.addEventListener("click", function (e) {
      let total = 0;
      e.preventDefault();
      let orders = [];
      let allProducts = document.querySelectorAll(".single-product");
      allProducts.forEach((product) => {
        let cartID = product.querySelector(".removeFromCart i");
        cartID = cartID.getAttribute("data-id");
        console.log(cartID);
        let productId = product.getAttribute("data-product");
        let locationId = product.getAttribute("data-location");
        let price = product.querySelector(".price").textContent;
        price = price.substring(1, price.length);
        price = parseFloat(price);
        let qty = product.querySelector(".qty").textContent;
        qty = parseInt(qty);
        let sizeId = product.querySelector(".size").getAttribute("data-size");
        let order = {
          cart: cartID,
          product: productId,
          location: locationId,
          price: price,
          qty: qty,
          sizeId: sizeId,
        };
        orders.push(order);
        total += price * qty;
        
      });

      total += 20;
      total = total.toFixed(2)
      let data = {
        user: id,
        total: total,
        products: orders,
      };

      ajaxCallBack(
        "logic/orders.php",
        data,
        function (data) {
          prodCt.innerHTML = `<h3 class"h3 alert alert-success">${data}</h3>`;
          subtotal()
        },
        function (xhr) {
          console.log(xhr);
        }
      );
    });
  } else if (document.location.pathname.includes("poll.php")) {
    let submitBtn = document.querySelector("#submitPoll");
    let choices = this.document.querySelectorAll(".choice");
    submitBtn.addEventListener("click", function (e) {
      e.preventDefault();
      let error = 0;
      choices.forEach((e) => {
        if (e.checked) {
          let id = e.value;
          if (!choicesData.includes(id)) choicesData.push(id);

          console.log(choicesData);
        } else {
          error++;
          let id = e.value;
          choicesData = choicesData.filter((x) => x != id);
        }
      });

      let userid = document.querySelector(".poll-ct").getAttribute("data-user");
      data = {
        idUser: userid,
        ids: choicesData,
      };

      ajaxCallBack(
        "logic/insertAnswer.php",
        data,
        function (data) {
          document.querySelector(
            ".msg"
          ).innerHTML = `<p class='text-center alert alert-${
            data == "Empty data" ? "danger" : "success"
          }'>${data}</p>`;
        },
        function (xhr) {
          document.querySelector(
            ".msg"
          ).innerHTML = `<p class='text-center alert alert-danger'>${xhr.responseJSON}</p>`;
        }
      );
      // } else {
      //   document.querySelector(".msg").innerHTML =
      //     "<p class='text-center alert alert-danger'>Please choose at least one answer</p>";
      // }
    });
  }
});

function getRecension(id) {
  let data = {
    id: id,
  };
  ajaxCallBack(
    "logic/loadRecension.php",
    data,
    function (recensions) {
      setRecension(recensions);
    },
    function (xhr) {
      console.log(xhr);
    }
  );
}

function setRecension(recensions) {
  let container = document.querySelector(".rewiews-block");
  container.innerHTML = "";
  recensions.forEach((recension) => {
    container.innerHTML += `
    <div class="edu-comment">
    <div class="thumbnail"> <img class='rec-img' src="${recension[
      "profile_img"
    ].substring(
      3,
      recension["profile_img"].length
    )}" alt="Comment Images"> </div>
    <div class="comment-content">
      <div class="comment-top">
        <h6 class="title">${recension["first_name"]} ${
      recension["last_name"]
    }</h6>
        <div class="rating"> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i> </div>
      </div>
      <span class="subtitle text-dark">“ ${recension["title"]} ”</span>
      <p>${recension["content"]}</p>
    </div>
  </div>
    `;
  });
}

function getProductForCart() {
  let userid = document.querySelector("#user");
  let id = userid.getAttribute("data-id");
  let prodCt = document.querySelector(".cart-product-ct");
  prodCt.innerHTML = "";
  data = {
    type: "get",
    user: id,
  };

  ajaxCallBack(
    "logic/get-removeProductsFromCart.php",
    data,
    function (products) {
      products.forEach((product) => {
        prodCt.innerHTML += `
        <div class="card mb-3">
        <div class="card-body single-product" data-product='${product["product_id"]}' data-location='${product["location_id"]}'>
            <div class="d-flex justify-content-between">
            <div class="d-flex flex-row align-items-center">
                <div>
                <img
                    src="assets/img/productImg/${product["main_img"]}"
                    class="img-fluid rounded-3" alt="Shopping item" style="width: 65px;">
                </div>
                <div class="ms-3">
                <h5>${product["name"]}</h5>
                <p class="small mb-0 size" data-size='${product["size_id"]}'>Size: ${product["size"]}</p>
                </div>
            </div>
            <div class="d-flex flex-row align-items-center">
                <div class='d-flex' style="width: 80px;">
                <h5 class="fw-normal mr-2">x</h5>
                <h5 class="fw-normal mb-0 qty">${product["quantity"]}</h5>
                
                </div>
                <div style="width: 80px;">
                <h5 class="mb-0 price">$${product["price"]}</h5>
                </div>
                <a href="#!" style="color: #cecece;" class="removeFromCart" ><i class="fas fa-trash-alt" data-id="${product["cart_id"]}"></i></a>
            </div>
            </div>
        </div>
        </div>
        `;
      });
      subtotal();
      removeProductFromCart();
    },
    function (xhr) {
      prodCt.innerHTML = `<h3 class='h3'>Empty cart</h3>`;
      let btn = document.querySelector(".checkout-btn");
      btn.setAttribute("disabled", "enable");
    }
  );
}

function editUser() {
  let greske = 0;
  let fName = document.querySelector("#UFName");
  let lName = document.querySelector("#ULName");
  let email = document.querySelector("#UEmail");
  let password = document.querySelector("#UNPass");
  let confirmPassword = document.querySelector("#UNCPass");
  let ddlGenders = document.querySelector("#ddlGenders");
  let profileImg = document.querySelector("#profileImg");

  if (!nameRegex.test(fName.value)) greske++;
  if (!nameRegex.test(lName.value)) greske++;
  if (!mailRegex.test(email.value)) greske++;
  if (!passwordRegex.test(password.value)) greske++;
  if (!passwordRegex.test(confirmPassword.value)) greske++;
  if (!greske == 0) return false;
  return true;
}
function addLocation() {
  let greske = 0;
  let country = document.querySelector("#country");
  let city = document.querySelector("#city");
  let address = document.querySelector("#addresses");

  if (!nameRegex.test(country.value)) greske++;
  if (!nameRegex.test(city.value)) greske++;
  if (!addressRegex.test(address.value)) greske++;

  if (!greske == 0) return false;
  return true;
}
// Edit user
function removeProductFromCart() {
  let removeBtn = document.querySelectorAll(".removeFromCart");
  removeBtn.forEach((remBtn) => {
    remBtn.addEventListener("click", function (e) {
      e.preventDefault();
      let id = e.target.getAttribute("data-id");
      data = {
        type: "remove",
        cartID: id,
      };
      ajaxCallBack(
        "logic/get-removeProductsFromCart.php",
        data,
        function (data) {
          getProductForCart();
          subtotal();
        },
        function (xhr) {
          console.log(xhr);
        }
      );
    });
  });
}
function subtotal() {
  let singleprod = document.querySelectorAll(".single-product");
  let subtotal = document.querySelector(".subtotal");
  let total = document.querySelector(".total");
  let sum = 0;
  singleprod.forEach((prod) => {
    let price = prod.querySelector(".price").textContent;
    price = price.substring(1, price.length);
    price = parseFloat(price);
    let qty = prod.querySelector(".qty").textContent;
    qty = parseInt(qty);
    sum += price * qty;
  });
  let suma = sum;
  suma = suma.toFixed(2);
  suma = parseFloat(suma)
  console.log(suma)
  subtotal.innerHTML = `$${suma}`;
  total.innerHTML = `$${(suma + 20).toFixed(2)}`;
}

function finallyFilter() {
  let data = {
    page: strana,
    genderArray: genderData,
    categoryArray: categoryData,
    brandArray: brandData,
    search: searchData,
    sortType: sortData,
  };
  ajaxCallBack(
    "logic/loadProducts.php",
    data,
    function (products) {
      console.log(products);
      ispisProizvoda(products);
    },
    function (xhr) {
      document.querySelector(
        ".products-container"
      ).innerHTML = `<p class="productMessage">${xhr.responseJSON}</p>`;
      next.prop("disabled", true);
      strana--;
      localStorage.setItem("strana", strana);
    }
  );
}

// function sortFunction() {

// }

function checkBoxValidator(e, array, type) {
  let cbValue = e.target.getAttribute("data-category");
  strana = 1;
  localStorage.setItem("strana", strana);
  if (e.target.checked) {
    if (!array.includes(cbValue)) {
      array.push(cbValue);
    }
  } else {
    if (type == "category")
      categoryData = categoryData.filter((x) => x != cbValue);
    if (type == "brand") brandData = brandData.filter((x) => x != cbValue);
    if (type == "gender") genderData = genderData.filter((x) => x != cbValue);
  }

  finallyFilter();
}

function loadProducts() {
  finallyFilter();
}

function ispisProizvoda(products) {
  console.log(products.length);
  if (products.length < 9) {
    next.prop("disabled", true);
    console.log(next);
  } else {
    next.prop("disabled", false);
  }
  document.querySelector(".products-container").innerHTML = "";
  products.forEach((product) => {
    document.querySelector(".products-container").innerHTML += `
    <div class="col-md-4">
    <div class="card mb-4 product-wap rounded-0">
        <div class="card img-ct rounded-0">
            <img class="card-img rounded-0 img-fluid" src="assets/img/productImg/${product.main_img}">
            <div class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
                <ul class="list-unstyled">
                    
                    <li id="${product.product_id}"><a class="btn btn-success text-white mt-2" href="shop-single.php?id=${product.product_id}"><i class="far fa-eye"></i></a></li>
                    
                </ul>
            </div>
        </div>
        <div class="card-body card-ct">
            <a href="shop-single.php" class="h3 text-decoration-none">${product.name}</a>
            <ul class="w-100 list-unstyled d-flex justify-content-between mb-0">
                <li class="pt-2">
                    <span class="product-color-dot color-dot-red float-left rounded-circle ml-1"></span>
                    <span class="product-color-dot color-dot-blue float-left rounded-circle ml-1"></span>
                    <span class="product-color-dot color-dot-black float-left rounded-circle ml-1"></span>
                    <span class="product-color-dot color-dot-light float-left rounded-circle ml-1"></span>
                    <span class="product-color-dot color-dot-green float-left rounded-circle ml-1"></span>
                </li>
            </ul>
            <ul class="list-unstyled d-flex justify-content-center mb-1">
                <li>
                    <i class="text-warning fa fa-star"></i>
                    <i class="text-warning fa fa-star"></i>
                    <i class="text-warning fa fa-star"></i>
                    <i class="text-muted fa fa-star"></i>
                    <i class="text-muted fa fa-star"></i>
                </li>
            </ul>
            <p class="text-center mb-0">$${product.price}</p>
        </div>
    </div>
</div>
    `;
  });
}

function registracija() {
  greske = 0;
  let firstName, lastName, email, password, confirmPassword, genders;
  firstName = $("#Fname");
  lastName = $("#Lname");
  email = $("#email");
  password = $("#password");
  confirmPassword = $("#confirmPass");

  genders = $("input[name='gender']:checked").val();

  console.log(genders);
  if (genders == undefined) {
    greske++;
    $(".radioGreske").html("Please choose gender");
  }

  checkValuesWithRegex(
    firstName,
    nameRegex,
    "Incorrect first name! First letter must be big"
  );
  checkValuesWithRegex(
    lastName,
    nameRegex,
    "Incorrect last name! First letter must be big"
  );
  checkValuesWithRegex(
    email,
    mailRegex,
    "Incorrect email! Example(miroslav@gmail.com)"
  );
  checkValuesWithRegex(
    password,
    passwordRegex,
    "Incorrect password! Password must hava one special character, Big letters, numbers"
  );

  if (password.val() != confirmPassword.val()) {
    greske++;
    confirmPassword.next().html("Password do not match");
  }

  if (greske == 0) {
    data = {
      firstname: firstName.val(),
      lastname: lastName.val(),
      email: email.val(),
      password: password.val(),
      gender: genders,
    };

    ajaxCallBack(
      "logic/registracija.php",
      data,
      function (result) {
        $(".hidden").addClass("successRegister");
        setTimeout(function () {
          $(".hidden").removeClass("successRegister");
        }, 3400);
      },
      function (xhr) {
        console.log(xhr);
      }
    );
  }
}

function provera() {
  let name = document.querySelector("#name");
  let email = document.querySelector("#email");
  let subject = document.querySelector("#subject");
  let message = document.querySelector("#message");
  let errors = document.querySelector(".errorsContact");

  let mailRegex = /^[A-z0-9-\.]{3,30}@[a-z]{2,8}\.(com|rs)$/;
  let nameRegex = /^[A-Z][a-z]{2,14}$/;

  let errorsNum = 0;
  if (
    name.value == "" ||
    email.value == "" ||
    subject.value == "" ||
    message.value == ""
  ) {
    errors.innerHTML +=
      "<p class='alert alert-danger'>All fields are required</p>";
    errorsNum++;
  }
  if (!mailRegex.test(email.value)) {
    errors.innerHTML +=
      "<p class='alert alert-danger'>Incorect email: name@gmail.com</p>";
    errorsNum++;
  }
  if (!nameRegex.test(name.value)) {
    errors.innerHTML +=
      "<p class='alert alert-danger'>Incorect name: exemple(Miroslav)</p>";
    errorsNum++;
  }
  if (errorsNum != 0) return false;
  return true;
}

function checkValuesWithRegex(input, regex, message) {
  if (!regex.test(input.val())) {
    greske++;
    input.css("border-color", "red");
    input.next().html(message);
  } else {
    input.css("border-color", "#2d343f5e");
    input.next().html("");
  }
}

function checkEmptyValues(input, greske) {
  if (input.value == "") {
    // input.next().html("Please enter value in field");
    greskelogin++;
  } else input.next().html("");
}

function ajaxCallBack(url, data, result, error) {
  $.ajax({
    url: url,
    method: "post",
    data: data,
    dataType: "json",
    success: result,
    error: error,
  });
}
