	//textos em maiusculo
    document.getElementById('resolucao').addEventListener('keyup', (ev) => {
        const input = ev.target;
        input.value = input.value.toUpperCase();
    });
    
    document.getElementById('defeito').addEventListener('keyup', (ev) => {
        const input = ev.target;
        input.value = input.value.toUpperCase();
    });