// PROTECTION PAGE
if (location.pathname.includes("records") && !localStorage.getItem("user")) {
    window.location.href = "index.html";
}

// LOGIN
function login() {
    const user = document.getElementById("username").value;
    if (user) {
        localStorage.setItem("user", user);
        localStorage.setItem("records", JSON.stringify([]));
        window.location.href = "records.html";
    }
}

// LOGOUT
function logout() {
    localStorage.removeItem("user");
    window.location.href = "index.html";
}

// AJOUT RECORD
function addRecord() {
    const circuit = document.getElementById("circuit").value;
    const car = document.getElementById("car").value;
    const time = document.getElementById("time").value;

    let records = JSON.parse(localStorage.getItem("records"));
    records.push({ circuit, car, time, value: timeToMs(time) });

    records.sort((a, b) => a.value - b.value);
    localStorage.setItem("records", JSON.stringify(records));
    renderRecords();
}

// CONVERSION TEMPS
function timeToMs(time) {
    const [min, rest] = time.split(":");
    return parseInt(min) * 60000 + parseFloat(rest.replace(",", ".")) * 1000;
}

// AFFICHAGE
function renderRecords() {
    const table = document.getElementById("recordsTable");
    if (!table) return;

    table.innerHTML = "";
    const records = JSON.parse(localStorage.getItem("records"));

    records.forEach(r => {
        table.innerHTML += `
        <tr>
            <td>${r.circuit}</td>
            <td>${r.car}</td>
            <td>${r.time}</td>
        </tr>`;
    });
}

renderRecords();
