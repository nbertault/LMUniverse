// PROTECTION DES PAGES
if (location.pathname.includes("records") && !localStorage.getItem("user")) {
    window.location.href = "index.html";
}

// LOGIN
function login() {
    const user = document.getElementById("username").value.trim();
    if (!user) return;

    localStorage.setItem("user", user);

    if (!localStorage.getItem("records")) {
        localStorage.setItem("records", JSON.stringify([]));
    }

    window.location.href = "records.html";
}

// LOGOUT
function logout() {
    localStorage.clear();
    window.location.href = "index.html";
}

// AJOUT RECORD
function addRecord() {
    const circuit = document.getElementById("circuit").value;
    const car = document.getElementById("car").value;
    const time = document.getElementById("time").value;

    if (!circuit || !car || !time) return;

    const records = JSON.parse(localStorage.getItem("records"));

    records.push({
        circuit,
        car,
        time,
        value: timeToMs(time)
    });

    records.sort((a, b) => a.value - b.value);

    localStorage.setItem("records", JSON.stringify(records));
    renderRecords();
}

// CONVERSION TEMPS
function timeToMs(time) {
    const [min, sec] = time.split(":");
    return parseInt(min) * 60000 + parseFloat(sec.replace(",", ".")) * 1000;
}

// AFFICHAGE
function renderRecords() {
    const table = document.getElementById("recordsTable");
    if (!table) return;

    table.innerHTML = "";
    const records = JSON.parse(localStorage.getItem("records"));

    records.forEach((r, i) => {
        table.innerHTML += `
            <tr>
                <td>${i + 1}</td>
                <td>${r.circuit}</td>
                <td>${r.car}</td>
                <td>${r.time}</td>
            </tr>
        `;
    });
}

renderRecords();
