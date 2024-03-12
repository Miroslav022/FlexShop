$(document).ready(function () {
  let addSizeBtn = $("#addSizeBtn");
  let sizeDdl = $("#addSizeDdl");
  let productId = $("#productName").attr("data-id");
  if (document.location.pathname.includes("editPage.php")) {
      
    //add product size
    addSizeBtn.on("click", function (e) {
      e.preventDefault();
      productId = $("#productName").attr("data-id");
      console.log(productId);
      let sizeId = sizeDdl.val();
      data = {
        id: sizeId,
        productId: productId,
      };
      ajaxCallBack(
        "../logic/addSize.php",
        data,
        function (data) {
          $(".successInsertMessage").html(data);
          avalibleProductSize(productId);
        },
        function (xhr) {
          console.log(xhr);
        }
      );
    });
getProductSpecification(productId);
    //Avalible product size
    avalibleProductSize(productId);
    //remove product Size
    $(document).on("click", ".removeSize", function (e) {
      e.preventDefault();
      productId = $("#productName").attr("data-id");
      let sizeBtn = e.target;
      let sizeId = sizeBtn.id;
      let data = {
        productId: productId,
        sizeId: sizeId,
      };
      ajaxCallBack(
        "../logic/removeSize.php",
        data,
        function (data) {
          console.log(data);
          avalibleProductSize(productId);
        },
        function (xhr) {
          console.log(xhr);
        }
      );
    });

    //Product images
    getAllProductImages(productId);
    $(document).on("click", ".removeProdImg", function (e) {
      e.preventDefault();
      let idImg = e.target.id;
      data = {
        img: idImg,
        productId: productId,
      };
      ajaxCallBack(
        "../logic/removeProductImg.php",
        data,
        function (data) {
          getAllProductImages(productId);
        },
        function (xhr) {
          console.log(xhr);
        }
      );
    });

    //specification
    getProductSpecification(productId);
    //update Specification
    $(document).on("click", ".specBtn", function (e) {
      e.preventDefault();
      let specId = e.target.getAttribute("data-specID");
      let specValue = document.querySelector(`#spec-value${specId}`);
      specValue = specValue.value;
      data = {
        productId: productId,
        specId: specId,
        value: specValue,
      };
      ajaxCallBack(
        "../logic/editSpec.php",
        data,
        function (data) {
          getProductSpecification(productId);
        },
        function (xhr) {
          console.log(xhr);
        }
      );
    });
    //Remove Specification
    $(document).on("click", ".removeSpecBtn", function (e) {
      e.preventDefault();
      let specId = e.target.getAttribute("data-specID");
      data = {
        productId: productId,
        specId: specId,
      };
      ajaxCallBack(
        "../logic/removeSpec.php",
        data,
        function (data) {
          getProductSpecification(productId);
        },
        function (xhr) {
          console.log(xhr);
        }
      );
    });
    //add specification
    let addSpecBtn = document.querySelector("#addSpec");
    addSpecBtn.addEventListener("click", function (e) {
      e.preventDefault();
      let value = document.querySelector("#specificationValue").value;
      let specDdl = document.querySelector("#specDdl").value;
      data = {
        productId: productId,
        value: value,
        specDdl: specDdl,
      };
      ajaxCallBack(
        "../logic/addSpec.php",
        data,
        function (data) {
          console.log(data);
          getProductSpecification(productId);
        },
        function (xhr) {
          console.log(xhr);
        }
      );
    });
  } else if (document.location.pathname.includes("products.php")) {
    //load Products
    loadProduct();

    //Remove product
    $(document).on("click", ".removeProductBtn", function (e) {
      e.preventDefault();
      let id = e.target.getAttribute("data-id");
      data = {
        id: id,
      };
      ajaxCallBack(
        "../logic/removeProduct.php",
        data,
        function (data) {
          loadProduct();
        },
        function (xhr) {
          console.log(xhr);
        }
      );
    });

    //filter product
    let filterBtn = $(".filterBtn");
    filterBtn.on("click", function (e) {
      e.preventDefault();
      let search = $(".search").val();
      let category = $("#ddlCat").val().toLowerCase();
      let brand = $("#ddlBrand").val();
      let data = {};

      if (category != 0) {
        data.categoryId = category;
      }
      if (brand != 0) {
        data.brandId = brand;
      }
      if (search != "") {
        data.search = search;
      }
      ajaxCallBack(
        "../logic/loadProduct.php",
        data,
        function (products) {
          setProducts(products);
        },
        function (xhr) {
          console.log(xhr);
        }
      );
    });
  } else if (document.location.pathname.includes("categories.php")) {
    //Categories
    getCategories();

    $(document).on("click", ".removeCategoryBtn", function (e) {
      e.preventDefault();
      let categoryId = e.target.getAttribute("data-id");
      data = {
        type: "remove",
        id: categoryId,
      };
      ajaxCallBack(
        "../logic/UpdateDeleteInsertCategory.php",
        data,
        function (data) {
          getCategories();
        },
        function (xhr) {
          console.log(xhr);
        }
      );
    });
  } else if (document.location.pathname.includes("brands.php")) {
    getBrands();
    $(document).on("click", ".removeBrandBtn", function (e) {
      e.preventDefault();
      let brandId = e.target.getAttribute("data-id");
      data = {
        type: "remove",
        id: brandId,
      };
      ajaxCallBack(
        "../logic/UpdateDeleteInsertBrand.php",
        data,
        function (data) {
          getBrands();
        },
        function (xhr) {
          console.log(xhr);
        }
      );
    });
  } else if (document.location.pathname.includes("users.php")) {
    getUsers();
    $(document).on("click", ".removeUserBtn", function (e) {
      e.preventDefault();
      let userId = e.target.getAttribute("data-id");
      console.log(userId);
      data = {
        type: "remove",
        id: userId,
      };
      ajaxCallBack(
        "../logic/UpdateDeleteInsertUser.php",
        data,
        function (data) {
          getUsers();
        },
        function (xhr) {
          console.log(xhr);
        }
      );
    });
  } else if (document.location.pathname.includes("message.php")) {
    getMessages();
    $(document).on("click", ".checkMessage", function (e) {
      e.preventDefault();
      let messageId = e.target.getAttribute("data-id");
      data = {
        type: "remove",
        id: messageId,
      };
      ajaxCallBack(
        "../logic/get-deleteMessages.php",
        data,
        function () {
          getMessages();
        },
        function (xhr) {
          console.log(xhr);
        }
      );
    });
  } else if (document.location.href.includes("deletedData.php?table=users")) {
    //users
    let userBlock = document.querySelector("#userDeletedBody");
    getDeletedRows("users", userBlock);
    returnBack("users", userBlock);
  } else if (document.location.href.includes("deletedData.php?table=brands")) {
    //Brands
    let brandBlock = document.querySelector("#brandDeletedBody");
    getDeletedRows("brands", brandBlock);
    returnBack("brands", brandBlock);
  } else if (
    document.location.href.includes("deletedData.php?table=categories")
  ) {
    //Categories
    let categoryBlock = document.querySelector("#categoryDeletedBody");
    getDeletedRows("categories", categoryBlock);
    returnBack("categories", categoryBlock);
  } else if (
    document.location.href.includes("deletedData.php?table=products")
  ) {
    //Products
    let productBlock = document.querySelector("#productDeletedBody");
    getDeletedRows("products", productBlock);
    returnBack("products", productBlock);
  }

  function returnBack(table, block) {
    $(document).on("click", ".returnRowBtn", function (e) {
      e.preventDefault();
      let id = e.target.getAttribute("data-id");
      data = {
        type: table,
        id: id,
      };
      ajaxCallBack(
        "../logic/returnBackRow.php",
        data,
        function (data) {
          getDeletedRows(table, block);
        },
        function (xhr) {
          console.log(xhr);
        }
      );
    });
  }
});

function avalibleProductSize(productId) {
  let data = {
    productId: productId,
  };
  ajaxCallBack(
    "../logic/getAllProductSize.php",
    data,
    function (sizes) {
      setAvalibleSize(sizes);
    },
    function (xhr) {
      console.log(xhr);
    }
  );
}

//specification
function getProductSpecification(productId) {
  data = {
    id: productId,
  };
  ajaxCallBack(
    "../logic/productSpecification.php",
    data,
    function (specification) {
      setSpec(specification);
    },
    function (xhr) {
      console.log(xhr);
    }
  );
}
function setSpec(specification) {
  console.log(specification);
  let specCt = document.querySelector(".specification-container");
  specCt.innerHTML = "";
  specification.forEach((spec) => {
    specCt.innerHTML += `
      <div class="spec mb-3 d-flex align-items-center">
        <h5 class="my-0 mx-2">${spec["type"]}</h5>
        <input type="text" id="spec-value${spec["specification_id"]}" value="${spec["value"]}">
        <input type="button" data-specID="${spec["specification_id"]}" class="specBtn ml-2 btn btn-sm btn-primary" value="Update">
        <input type="button" data-specID="${spec["specification_id"]}" class="removeSpecBtn ml-2 btn btn-sm btn-danger" value="Remove">
      </div>
    `;
  });
}

function getMessages() {
  data = {
    type: "get",
  };
  ajaxCallBack(
    "../logic/get-deleteMessages.php",
    data,
    function (data) {
      setMessages(data);
    },
    function (xhr) {
      console.log(xhr);
    }
  );
}

function setMessages(messages) {
  console.log(messages);
  let messageBlock = document.querySelector("#messageBody");
  messageBlock.innerHTML = "";
  let i = 1;
  messages.forEach((message) => {
    messageBlock.innerHTML += `
    <tr>
                      <th scope="row">${i++}</th>
                      <td data-title="Name">${message["name"]}</td>
                      <td data-title="Email">${message["email"]}</td>
                      <td data-title="Subject">${message["subject"]}</td>
                      <td data-title="Message" ><p>${
                        message["message"]
                      }</p></td>
                      <td><a href="#" class="btn btn-danger checkMessage" data-id="${
                        message["message_id"]
                      }">Delete</a></td>
                  </tr>     
    `;
  });
}

function getDeletedRows(table, block) {
  data = {
    table: table,
  };
  ajaxCallBack(
    "../logic/deletedRows.php",
    data,
    function (data) {
      setDeletedRow(data, block, table);
    },
    function (xhr) {
      block.innerHTML = `<h1 class='text-danger'>${xhr.responseJSON}</h1>`;
    }
  );
}

function setDeletedRow(data, block, table) {
  let i = 1;
  block.innerHTML = "";
  data.forEach((e) => {
    console.log(e);
    if (table == "users") {
      block.innerHTML += `
          <tr>
              <th scope="row">${i++}</th>
              <td data-title="First name">${e["first_name"]}</td>
              <td data-title="Last name">${e["last_name"]}</td>
              <td data-title="Email">${e["email"]}</td>
              <td data-title="Image">${e["profile_img"]}</td>
              <td data-title="Role">${e["role"]}</td>
              <td data-title="Location">${
                e["location"] != undefined ? e["location"] : "Empty"
              }</td>
              <td data-title="Gender">${e["gender"]}</td>
              <td><a href="#" data-id=${
                e["user_id"]
              } class="returnRowBtn btn btn-warning">Return back</a></td>
              
          </tr>      
      `;
    } else if (table == "categories") {
      block.innerHTML += `
      <tr>
      <th scope="row">${i++}</th>
      <td data-title="Category">${e["category_name"]}</td>
      <td><a href="#" data-id=${
        e["id"]
      } class="returnRowBtn btn btn-warning">Return back</a></td>
      
  </tr>
      
      `;
    } else if (table == "brands") {
      block.innerHTML += `
            <tr>
              <th scope="row">${i++}</th>
              <td data-title="Brand">${e["brand_name"]}</td>
              <td><a href="#" data-id=${
                e["id"]
              } class="returnRowBtn btn btn-warning">Return back</a></td>
              
          </tr>
      
      `;
    } else if (table == "products") {
      block.innerHTML += `
      <tr>
      <th scope="row">${i++}</th>
      <td data-title="Name">${e["name"]}</td>
      <td data-title="Category">${e["category_name"]}</td>
      <td data-title="Brand">${e["brand_name"]}</td>
      <td data-title="Price">$${e["price"]}</td>
      <td data-title="Image"><img src="../assets/img/productImg/${
        e["main_img"]
      }" alt="" height="200px"></td>
      <td data-title="Description">${e["description"]}</td>
      <td><a href="#" data-id=${
        e["product_id"]
      } class="returnRowBtn btn btn-warning">Return back</a></td>
      </tr>
      `;
    }
  });
}

function getAllProductImages(productId) {
  let data = {
    productId: productId,
  };
  ajaxCallBack(
    "../logic/getallImages.php",
    data,
    function (images) {
      console.log(data);
      setimages(images);
    },
    function (xhr) {
      console.log(xhr);
    }
  );
}

function getCategories() {
  data = {
    1: 1,
  };
  ajaxCallBack(
    "../logic/loadCategories.php",
    data,
    function (categories) {
      setCategories(categories);
    },
    function (xhr) {
      console.log(xhr);
    }
  );
}
function getUsers() {
  data = {
    1: 1,
  };
  ajaxCallBack(
    "../logic/loadUser.php",
    data,
    function (users) {
      setUsers(users);
    },
    function (xhr) {
      console.log(xhr);
    }
  );
}

function getBrands() {
  data = {
    1: 1,
  };
  ajaxCallBack(
    "../logic/loadbrands.php",
    data,
    function (brands) {
      setBrands(brands);
    },
    function (xhr) {
      console.log(xhr);
    }
  );
}

function setAvalibleSize(sizes) {
  let sizesBlock = document.querySelector(".sizes");
  sizesBlock.innerHTML = "";
  sizes.forEach((size) => {
    sizesBlock.innerHTML += `
            <div class="size d-flex my-3 align-items-center">
                            <h4 class="mr-3 my-0 mx-0">${size["size"]}</h4>
            <a href="#" id="${size["id"]}" class="btn btn-danger btn-sm removeSize">Delete</a></div>
        `;
  });
}

function setimages(images) {
  let imgContainer = document.querySelector(".img-container");
  imgContainer.innerHTML = "";
  images.forEach((img) => {
    imgContainer.innerHTML += `
                    <div class="img-block my-3">
                        <img src="../assets/img/productImg/${img["src"]}" alt="productImage${img["id"]}" class="ProductImg">
                        <a href="#" class="btn btn-danger btn-sm removeProdImg" id="${img["id"]}">Remove</a>
                    </div>
        `;
  });
}

function loadProduct() {
  data = {
    1: 1,
  };
  ajaxCallBack(
    "../logic/loadProduct.php",
    data,
    function (products) {
      console.log(products);
      setProducts(products);
    },
    function (xhr) {
      console.log(xhr);
    }
  );
}

function setProducts(products) {
  let productBlock = document.querySelector("#productBody");
  productBlock.innerHTML = "";
  let i = 1;
  products.forEach((product) => {
    productBlock.innerHTML += `
                  <tr>
                    <th scope="row">${i++}</th>
                    <td data-title="Name">${product["name"]}</td>
                    <td data-title="Category">${product["category_name"]}</td>
                    <td data-title="Brand">${product["brand_name"]}</td>
                    <td data-title="Price">$${product["price"]}</td>
                    <td data-title="Image"><img src="../assets/img/productImg/${
                      product["main_img"]
                    }" alt="" height="200px"></td>
                    <td data-title="Description">${product["description"]}</td>
                    <td><a href="editPage.php?table=products&id=${
                      product["product_id"]
                    }" class="btn btn-warning">Edit</a></td>
                    <td><a href="#" class="btn btn-danger removeProductBtn" data-id="${
                      product["product_id"]
                    }">Delete</a></td>
                  </tr>
    `;
  });
}

function setUsers(users) {
  let userBlock = document.querySelector("#userBody");
  userBlock.innerHTML = "";
  let i = 1;
  users.forEach((user) => {
    console.log(user);
    userBlock.innerHTML += `
                    <tr>
                      <th scope="row">${i++}</th>
                      <td data-title="First name">${user["first_name"]}</td>
                      <td data-title="Last name">${user["last_name"]}</td>
                      <td data-title="Email">${user["email"]}</td>
                      <td data-title="Image">${user["profile_img"]}</td>
                      <td data-title="Role">${user["role"]}</td>
                      <td data-title="Location">${
                        user["location"] != undefined
                          ? user["location"]
                          : "Empty"
                      }</td>
                      <td data-title="Gender">${user["gender"]}</td>
                      <td><a href="editPage.php?table=users&id=${
                        user["user_id"]
                      }" class="btn btn-warning">Edit</a></td>
                      <td><a href="#" class="btn btn-danger removeUserBtn" data-id="${
                        user["user_id"]
                      }">Delete</a></td>
                  </tr>           
    `;
  });
}
function setCategories(categories) {
  let categoryBlock = document.querySelector("#categoryBody");
  categoryBlock.innerHTML = "";
  let i = 1;
  categories.forEach((category) => {
    categoryBlock.innerHTML += `
                                <tr>
                                    <th scope="row">${i++}</th>
                                    <td data-title="Name">${
                                      category["category_name"]
                                    }</td>
                                    <td><a href="editPage.php?table=categories&id=${
                                      category["id"]
                                    }" class="btn btn-warning">Edit</a></td>
                                    <td><a href="#" class="btn btn-danger removeCategoryBtn" data-id="${
                                      category["id"]
                                    }">Delete</a></td>
                                </tr>
    `;
  });
}

function setBrands(brands) {
  let brandBlock = document.querySelector("#brandBody");
  brandBlock.innerHTML = "";
  let i = 1;
  brands.forEach((brand) => {
    brandBlock.innerHTML += `
                                <tr>
                                    <th scope="row">${i++}</th>
                                    <td data-title="Brand">${
                                      brand["brand_name"]
                                    }</td>
                                    <td><a href="editPage.php?table=brands&id=${
                                      brand["id"]
                                    }" class="btn btn-warning">Edit</a></td>
                                    <td><a href="#" class="btn btn-danger removeBrandBtn" data-id="${
                                      brand["id"]
                                    }">Delete</a></td>
                                </tr>
    `;
  });
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
