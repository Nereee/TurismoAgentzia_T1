  document.getElementById("pasahitzaikusi").addEventListener("click", function (event) {
      let pasahitza = document.getElementById('pasahitza');
      let checkbox = document.getElementById('pasahitzaikusi');

      if (checkbox.checked) {
          pasahitza.type = 'text';
      } else {
          pasahitza.type = 'password';
      }
  });