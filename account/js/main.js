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

function openTasks()
{
    var subjectSwiper = document.getElementsByClassName('subject__swiper');
    for (let i = 0; i < subjectSwiper.length; i++) {
        subjectSwiper[i].style.display = "block";
    }
    
    var sectionTask = document.getElementsByClassName('section-task');
    for (let i = 0; i < sectionTask.length; i++) {
        sectionTask[i].style.display = "block";
    }

}

function openStatistics()
{
    var subjectSwiper = document.getElementsByClassName('subject__swiper');
    for (let i = 0; i < subjectSwiper.length; i++) {
        subjectSwiper[i].style.display = "block";
    }

    var sectionTask = document.getElementsByClassName('section-task');
    for (let i = 0; i < sectionTask.length; i++) {
        sectionTask[i].style.display = "none";
    }
}

function openMaterials()
{
    var subjectSwiper = document.getElementsByClassName('subject__swiper');
    for (let i = 0; i < subjectSwiper.length; i++) {
        subjectSwiper[i].style.display = "none";
    }
    
    var sectionTask = document.getElementsByClassName('section-task');
    for (let i = 0; i < sectionTask.length; i++) {
        sectionTask[i].style.display = "none";
    }
}

function openProfile()
{
    var subjectSwiper = document.getElementsByClassName('subject__swiper');
    for (let i = 0; i < subjectSwiper.length; i++) {
        subjectSwiper[i].style.display = "none";
    }

    var sectionTask = document.getElementsByClassName('section-task');
    for (let i = 0; i < sectionTask.length; i++) {
        sectionTask[i].style.display = "none";
    }
}