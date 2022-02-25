const deleteElement = (id, name, rute) => {
      
    
      const form = document.getElementById('form');
      const spans = document.querySelectorAll('.name');

      spans.forEach((span) => {
            span.innerText = name;
      });

      form.action = `${rute}/${id}`;
};


const alerta = document.getElementById('alerta');

if (alerta != undefined) {
      setTimeout(() => {
            alerta.style.display = 'none';
      }, 3500);
}
