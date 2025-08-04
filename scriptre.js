const employees = [];
const allocations = [];

function addEmployee() {
  const name = document.getElementById('employeeName').value.trim();
  if (!name) return;

  if (employees.includes(name)) return alert("Employee already added.");

  employees.push(name);
  updateEmployeeSelect();
  document.getElementById('employeeName').value = '';
  updateChart();
}

function updateEmployeeSelect() {
  const select = document.getElementById('employeeSelect');
  select.innerHTML = '';
  employees.forEach(name => {
    const option = document.createElement('option');
    option.textContent = name;
    select.appendChild(option);
  });
}

function allocate() {
  const name = document.getElementById('employeeSelect').value;
  const percent = parseInt(document.getElementById('allocation').value);
  if (!name || isNaN(percent)) return;

  const index = allocations.findIndex(a => a.name === name);
  if (index > -1) {
    allocations[index].percent = percent;
  } else {
    allocations.push({ name, percent });
  }

  updateTable();
  updateChart();
  document.getElementById('allocation').value = '';
}

function updateTable() {
  const tbody = document.getElementById('allocationTable');
  tbody.innerHTML = '';
  allocations.forEach(entry => {
    const tr = document.createElement('tr');
    tr.innerHTML = `<td>Cosmetic</td><td>${entry.name} (${entry.percent}%)</td>`;
    tbody.appendChild(tr);
  });
}

let chart;
function updateChart() {
  const ctx = document.getElementById('workloadChart').getContext('2d');
  const data = {
    labels: allocations.map(e => e.name),
    datasets: [{
      label: 'Allocations(%)',
      data: allocations.map(e => e.percent),
      backgroundColor: '#009fe3',
      borderRadius: 10
    }]
  };

  if (chart) {
    chart.data = data;
    chart.update();
  } else {
    chart = new Chart(ctx, {
      type: 'bar',
      data,
      options: {
        scales: {
          y: {
            beginAtZero: true,
            max: 100
          }
        }
      }
    });
  }
}

