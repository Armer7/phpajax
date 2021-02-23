const cardsBlock = document.querySelector(".cards-block");

function requestDataGet(url, method, body = null) {
  let headers = {
    "Content-Type": "application/json;charset=utf-8",
  };
  let params = {};
  if (body) {
    params = {
      method: method,
      body: body,
      headers: headers,
    };
  }
  return fetch(url, params)
    .then((data) => {
      let responseData = data.json();
      if (data.ok) {
        return responseData;
      } else
        return responseData.then((error) => {
          let er = new Error("Error: Что-то пошло не так");
          er.data = error;
          throw er;
        });
    })
    .catch((error) => {
      console.log("errorData:", error);
    });
}

const getChange = (e) => {
  let url = `/action/query.php`;
  if (e) {
    const key = e.target.getAttribute("name");
    const value = e.target.value;
    url += `?${key}=${value}`;
  }
  requestDataGet(url, "GET")
    .then((data) => {
      cardsBlock.innerHTML = "";
      if (JSON.parse(data.item)) {
        data.product.forEach((item) => {
          cardsBlock.insertAdjacentHTML(
            "beforeend",
            `<div class="col-3">
        <div class="card mb-4">
        <div class="card-title text-center">${item.cat} ${item.title}</div>
      <div class="card-body">
        <p class="lead">Цвет: ${item.color}</p>
      <p class="lead">Вес: ${item.weight}</p>
      </div>
      </div>
      </div>`
          );
        });
      } else {
        cardsBlock.insertAdjacentHTML(
          "beforeend",
          `
         <h3>Товар не найден</h3>
         `
        );
      }
    })
    .catch((data) => {
      console.log("error in data", data);
    });
};

document.addEventListener("change", getChange);

getChange();
