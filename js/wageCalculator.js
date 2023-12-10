function calculateWage(wages) {
    const hoursWorked = parseFloat(document.getElementById('hours').value);
    const total = hoursWorked * wages;
    document.getElementById('result').innerText = `If you work ${hoursWorked} hours you will receive $${total.toFixed(2)}`;
  }
  