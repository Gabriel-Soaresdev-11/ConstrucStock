document.getElementById('telefone').addEventListener('input', function (e) {
        let value = e.target.value;
        value = value.replace(/\D/g, ''); // Remove tudo que não for dígito

        // Formata com (XX) XXXXX-XXXX
        if (value.length > 10) {
            value = value.replace(/^(\d{2})(\d{5})(\d{4}).*/, '($1) $2-$3');
        } 
        // Formata com (XX) XXXX-XXXX
        else if (value.length > 5) {
            value = value.replace(/^(\d{2})(\d{4})(\d{0,4}).*/, '($1) $2-$3');
        } 
        // Formata com (XX) XXXX
        else if (value.length > 2) {
            value = value.replace(/^(\d{2})(\d{0,5})/, '($1) $2');
        } 
        // Formata com (XX
        else {
            value = value.replace(/^(\d{0,2})/, '($1');
        }

        e.target.value = value;
    });

