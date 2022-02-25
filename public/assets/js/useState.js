   function useState(defaultValue) {
 
          let value = defaultValue;
         
          function getValue() {
              return value;
          }
          
          function setValue(newValue) {
              value = newValue;
              getValue(); 
          }
          
          return [getValue, setValue];
          
    }