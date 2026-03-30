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

    var sectionBooks = document.getElementsByClassName('section-books');
    for (let i = 0; i < sectionBooks.length; i++) {
        sectionBooks[i].style.display = "none";
    }

    var sectionMaterials = document.getElementsByClassName('section-materials');
    for (let i = 0; i < sectionMaterials.length; i++) {
        sectionMaterials[i].style.display = "none";
    }

    var sectionStudent = document.getElementsByClassName('section-student');
    for (let i = 0; i < sectionStudent.length; i++) {
        sectionStudent[i].style.display = "none";
    }

    var sectionParent = document.getElementsByClassName('section-parent');
    for (let i = 0; i < sectionParent.length; i++) {
        sectionParent[i].style.display = "none";
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

    var sectionBooks = document.getElementsByClassName('section-books');
    for (let i = 0; i < sectionBooks.length; i++) {
        sectionBooks[i].style.display = "none";
    }

    var sectionMaterials = document.getElementsByClassName('section-materials');
    for (let i = 0; i < sectionMaterials.length; i++) {
        sectionMaterials[i].style.display = "none";
    }

    var sectionStudent = document.getElementsByClassName('section-student');
    for (let i = 0; i < sectionStudent.length; i++) {
        sectionStudent[i].style.display = "none";
    }

    var sectionParent = document.getElementsByClassName('section-parent');
    for (let i = 0; i < sectionParent.length; i++) {
        sectionParent[i].style.display = "none";
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

    var sectionBooks = document.getElementsByClassName('section-books');
    for (let i = 0; i < sectionBooks.length; i++) {
        sectionBooks[i].style.display = "block";
    }

    var sectionMaterials = document.getElementsByClassName('section-materials');
    for (let i = 0; i < sectionMaterials.length; i++) {
        sectionMaterials[i].style.display = "block";
    }

    var sectionStudent = document.getElementsByClassName('section-student');
    for (let i = 0; i < sectionStudent.length; i++) {
        sectionStudent[i].style.display = "none";
    }

    var sectionParent = document.getElementsByClassName('section-parent');
    for (let i = 0; i < sectionParent.length; i++) {
        sectionParent[i].style.display = "none";
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

    var sectionBooks = document.getElementsByClassName('section-books');
    for (let i = 0; i < sectionBooks.length; i++) {
        sectionBooks[i].style.display = "none";
    }

    var sectionMaterials = document.getElementsByClassName('section-materials');
    for (let i = 0; i < sectionMaterials.length; i++) {
        sectionMaterials[i].style.display = "none";
    }

    var sectionStudent = document.getElementsByClassName('section-student');
    for (let i = 0; i < sectionStudent.length; i++) {
        sectionStudent[i].style.display = "block";
    }

    var sectionParent = document.getElementsByClassName('section-parent');
    for (let i = 0; i < sectionParent.length; i++) {
        sectionParent[i].style.display = "block";
    }
}