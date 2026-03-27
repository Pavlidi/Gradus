const tabs = document.querySelectorAll('.menu-item');
const contents = document.querySelectorAll('.tab-content');

tabs.forEach(tab => {
    tab.addEventListener('click', () => {

        const target = tab.dataset.tab;

        // активная кнопка
        tabs.forEach(t => t.classList.remove('active'));
        tab.classList.add('active');

        // активный контент
        contents.forEach(c => {
            c.classList.remove('active');

            if (c.id === target) {
                c.classList.add('active');
            }
        });

    });
});

const subjects = document.querySelectorAll('.subject');

subjects.forEach(subject => {
    subject.addEventListener('click', () => {

        subjects.forEach(t => t.classList.remove('active'));
        subject.classList.add('active');

    });
});