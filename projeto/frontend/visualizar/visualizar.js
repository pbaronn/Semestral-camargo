document.addEventListener('DOMContentLoaded', () => {
    // Formata campos especiais
    const dataNascimento = document.getElementById('dataNascimento');
    const cpf = document.getElementById('cpf');
    const tel1 = document.getElementById('tel1');
    const tel2 = document.getElementById('tel2');

    // Formatação de data
    dataNascimento.addEventListener('input', (e) => {
        let value = e.target.value.replace(/\D/g, '');
        if (value.length >= 2) value = value.substring(0,2) + '/' + value.substring(2);
        if (value.length >= 5) value = value.substring(0,5) + '/' + value.substring(5,8);
        e.target.value = value;
    });

    // Formatação de CPF
    cpf.addEventListener('input', (e) => {
        let value = e.target.value.replace(/\D/g, '');
        if (value.length >= 3) value = value.substring(0,3) + '.' + value.substring(3);
        if (value.length >= 7) value = value.substring(0,7) + '.' + value.substring(7);
        if (value.length >= 11) value = value.substring(0,11) + '-' + value.substring(11,13);
        e.target.value = value;
    });

    // Formatação de telefone
    function formataTelefone(e) {
        let value = e.target.value.replace(/\D/g, '');
        if (value.length >= 2) value = '(' + value.substring(0,2) + ') ' + value.substring(2);
        if (value.length >= 10) value = value.substring(0,10) + '-' + value.substring(10);
        e.target.value = value;
    }

    tel1.addEventListener('input', formataTelefone);
    tel2.addEventListener('input', formataTelefone);

    // Controle dos campos de radio e texto adicional
    const radioGroups = document.querySelectorAll('.checkbox-group');
    
    radioGroups.forEach(group => {
        const radios = group.querySelectorAll('input[type="radio"]');
        const descInput = group.querySelector('.form-input.hidden');
        
        radios.forEach(radio => {
            radio.addEventListener('change', () => {
                if (radio.value === 'sim') {
                    descInput.style.display = 'block';
                } else {
                    descInput.style.display = 'none';
                    descInput.value = '';
                }
            });
        });
    });

    // Botões de ação
    const btnvoltar = document.getElementById('btnvoltar');
   

    btnvoltar.addEventListener('click', () => {
        window.location.href = '../menu/menu.php';
    });

    

    inicio.addEventListener('click', () => {
        window.location.href = '../menu/menu.php';
    });

    config.addEventListener('click', () => {
        window.location.href = '../configuracoes/configuracoes.php';
    });

    sair.addEventListener('click', () => {
        window.location.href = '../login/login.php';
    });
});