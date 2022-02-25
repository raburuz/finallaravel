 const editCustompoke = (custom, rute) => {
            
      const form = document.getElementById('formUpdate');
      const spans = document.querySelectorAll('.name');
      const pokemon_id = document.querySelectorAll('#pokemon_id');
      const weight = document.querySelectorAll('#weight');
      const height = document.querySelectorAll('#height');
      const nickname = document.querySelectorAll('#nickname');
      const ability_id = document.querySelectorAll('[aria_ability]');
   
    
      spans.forEach((span) => {
            span.innerText = custom.nickname;
      });
      
      ability_id.forEach((option) => {
           if(option.value == custom.ability_id){
               option.setAttribute('selected', '')
           }
      });
      
    
      pokemon_id[0].value = custom.pokemon.id;
      weight[0].value = custom.weight;
      height[0].value =custom.height;
      nickname[0].value = custom.nickname;
      form.action = `${rute}/${custom.id}`;
};