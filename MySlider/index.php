<!DOCTYPE html>

<html>
    <head>
        <title>Мой слайдер</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="myStylesForSlider.css?<?=rand()?>"/>
    </head>
    <body>
        <div class="returnButton">
            <a href="http://164.90.183.202/">Назад</a>
	</div>
        <div class="photos" >
                <div class="bodyElement">
                    <div class="photoElement">
                        <img id="video1" class="video" src="video/pelmenCot.jpg">
                        <iframe hidden id = "video11" width="100%" height="100%" src="https://www.youtube.com/embed/ERORa-VCiWw" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                    <div class="photoElement">
                        <img id="video2" class="video" src="video/lasagnaHowToMakeBasic.jpg">
                        <iframe hidden id = "video22" width="100%" height="100%" src="https://www.youtube.com/embed/_xrgvJ7LNhk" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                    <div class="photoElement">
                        <img id="img1" class = "imgs" src="img/photo_1.jpg">
                    </div>
                    <div class="photoElement">
                        <img id="img2" class = "imgs" src="img/photo_2.jpg">
                    </div>
                    <div class="photoElement">
                        <img id="img3" class = "imgs" src="img/photo_3.jpg">
                    </div>
                    <div class="photoElement">
                        <img id="img4" class = "imgs" src="img/photo_4.jpg">
                    </div>
                    <div class="photoElement">
                        <img id="img5" class = "imgs" src="img/photo_5.jpg">
                    </div>
                    <div class="photoElement">
                        <img id="img6" class = "imgs" src="img/photo_6.jpg">
                    </div>
                    <div class="photoElement">
                        <img id="img7" class = "imgs" src="img/photo_7.jpg">
                    </div>
                    <div class="photoElement">
                        <img id="video3" class="video" src="video/danceAtCar.jpg">
                        <iframe hidden id = "video33" width="100%" height="100%" src="https://www.youtube.com/embed/VE2kGsKMHuo" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                    <div class="photoElement">
                        <img id="img8" class = "imgs" src="img/photo_8.jpg">
                    </div>
                    
                </div>
            </div>
        <div class = "popup" hidden>
            
        </div>
        <div class = "contentPopup" hidden>
            <div id="closePopup" class = "closePopup"><img src = "img/close.png"></div>
            <div class = mainPhotoElem>
                <div id = "back" class="backButton"><img src = "img/back.png"></div>
                <div class = "popupElements">
                    <img id = "openPhoto">
                </div> 
                <div id = "forward" class="forwardButton"><img src = "img/forward.png"></div>
            </div>
            <div id = "listPict" class = "photoList">
                 <div class = "photoOfList"><img></div>
                 <div class = "photoOfList"><img></div>
                 <div class = "photoOfList"><img></div>
                 <div class = "photoOfList"><img></div>
            </div>
            <div id="dots" class="sliderDots"></div>
        </div>
        
        <script>
            var openPicture = document.getElementsByClassName("photoElement");
            var closePopup = document.getElementById("closePopup");
            var forwardButton = document.getElementById("forward");
            var backButton = document.getElementById("back");
            var anotherClosePopup = document.getElementsByClassName("popup");
            var clickedDots;
            var listOfPictures = [];
            var listOfPicts= [];
            var listOfVideos = [];
            for (var i = 0; i < openPicture.length; i++)
            {
                openPicture[i].getElementsByTagName('img')[0].addEventListener('click', funcOpen);
                listOfPicts.push(openPicture[i].getElementsByTagName('img')[0].src);
                listOfPictures.push((openPicture[i].getElementsByTagName('img')[0]).cloneNode());
            }
            anotherClosePopup[0].addEventListener('click', funcClose);
            closePopup.addEventListener('click', funcClose);
            forwardButton.addEventListener('click', forward);
            backButton.addEventListener('click', back);
            document.addEventListener("DOMContentLoaded", createList); // при загрузке страницы
            var photoList = [];
            
            document.onkeydown = function(event) {  //обработка нажатия на клавишу
                if (document.getElementsByClassName("contentPopup")[0].hidden == false)
                    if (event.keyCode == 37) 
                        back();
                    else if (event.keyCode == 39)
                        forward();
                    else if (event.keyCode == 27)
                        funcClose();
            }
            function funcOpen() {   // открыть слайдер при клике на пикчу
                document.getElementsByClassName("popup")[0].hidden = false;
                document.getElementsByClassName("contentPopup")[0].hidden = false;
                var photo = document.getElementById('openPhoto');
                photo.src = event.target.src;
                photo.className = event.target.className;
                var index = listOfPicts.indexOf(photo.src);
                choseCurrentSegment(index);
                chosenPictOfList(photo, "open");
                isVideo();
            }
            function funcClose() {  // закрыть слайдер, при нажатии на соотв. кнопку
                document.getElementsByClassName("popup")[0].hidden = true;
                document.getElementsByClassName("contentPopup")[0].hidden = true;
                chosenPictOfList(document.getElementById('openPhoto'), "close");
            }
            
            function forward() {    // перейти на следующую пикчу
                var photo = document.getElementById('openPhoto');
                var index = listOfPicts.indexOf(photo.src);
                if (index + 1 < listOfPictures.length) {
                    photo.src = listOfPictures[index + 1].src;
                    photo.className = listOfPictures[index + 1].className;
                    if ((index + 1) % 4 == 0)
                        choseCurrentSegment(index+1);
                }
                else {
                    photo.src = listOfPictures[0].src;
                    photo.className = listOfPictures[0].className;
                    choseCurrentSegment(0);
                }
                chosenPictOfList(photo, "open");
                isVideo();
            }
            function back() {   // перейти на предыдущую пикчу
                var photo = document.getElementById('openPhoto');
                var index = listOfPicts.indexOf(photo.src);
                if (index - 1 >= 0) {
                    photo.src = listOfPictures[index - 1].src;
                    photo.className = listOfPictures[index - 1].className;
                    if ((index) % 4 == 0)
                        choseCurrentSegment(index-1);
                }
                else {
                    photo.src = listOfPictures[listOfPictures.length - 1].src;
                    photo.className = listOfPictures[listOfPictures.length - 1].className;
                    choseCurrentSegment(listOfPictures.length - 1);
                }
                chosenPictOfList(photo, "open");
                isVideo();
            }
            
            function choseCurrentSegment(index) {
            // переходить по сегментам с набором пикч в превью, которые соотв. активной пикче
                var pictsList = document.getElementsByClassName("photoOfList");
                for (i = 0; i < pictsList.length; i++) {
                    // очистим от всех картинок в блоках
                    if (pictsList[i].getElementsByTagName("img")[0])
                        pictsList[i].getElementsByTagName("img")[0].remove();
                }
                var k = 0;
                var currentIndx = Math.trunc(index/4);
                // выделяем корректную точку в превью
                for (var i = 0; i < clickedDots.length; i++) {
                    if (currentIndx == i)
                        clickedDots[i].style.backgroundColor = "#8EC3EB";
                    else
                        clickedDots[i].style.backgroundColor = "#ddd";
                }
                // выводи корректные пикчи в превью
                for (var j = currentIndx*4; j < currentIndx*4 + 4; j++) {
                    if (j < listOfPictures.length) {
                        var mg = listOfPictures[j];
                        mg.style.cssText = "width: 100%; height: 100%;";
                        pictsList[k].appendChild(mg);
                        k = k + 1;
                    }
                }
            }
            
            function createList() {     // функция по генерации превью картинок и их точки - только при загрузке страницы
                var dotsList = document.getElementById("dots");
                var pictsList = document.getElementsByClassName("photoOfList");
                var j = 1;
                for (var i = 0; i < listOfPictures.length; i++) {
                    // Тут вроде какая-то ошибка
                    //if (i < 4) {
                    //    var mg = listOfPictures[i];
                    //    mg.style.cssText = "width: 100%; height: 100%;";
                    //    pictsList[i].appendChild(mg);
                    //}
                    // создаем точки в превью
                    if ((i+1) % 4 == 0) {
                        var span = document.createElement('span');
                        span.style.cssText = 'cursor: pointer; height: 12px; width: 48px; margin: 0 5px; background-color: #ddd; border-radius: 15%; display: inline-block;';
                        span.id = "dot" + j;
                        dotsList.appendChild(span);
                        j = j + 1;
                    }
                    if (i+1 == listOfPictures.length && j*4 != i) {
                        var span = document.createElement('span');
                        span.style.cssText = 'cursor: pointer; height: 12px; width: 48px; margin: 0 5px; background-color: #ddd; border-radius: 15%; display: inline-block;';
                        span.id = "dot" + j;
                        dotsList.appendChild(span);
                        j = j + 1;
                    }
                }
                
                clickedDots = document.getElementById("dots").getElementsByTagName("span");
                for (var i = 0; i < clickedDots.length; i++) {
                    clickedDots[i].addEventListener('click', clickOnDots);
                }
                
                photoList = document.getElementsByClassName("photoOfList");
                for (var i = 0; i < photoList.length; i++) {
                    photoList[i].addEventListener('click', funcChoseFromList);
                }
            }
            function funcChoseFromList() {  // подгрузка пикчи, выбранной из превью
                var photo = document.getElementById('openPhoto');
                if (event.target.src) {
                    photo.src = event.target.src;
                    photo.className = event.target.className;
                    chosenPictOfList(photo, "open");
                    isVideo();
                }
            }
            function chosenPictOfList(Photo, OpnCls) {      // выделение выбранного элемента
                var photos = document.getElementsByClassName("photoOfList");
                if (OpnCls == "open") {
                    for (var i = 0; i < photos.length; i++) {
                        if (photos[i].getElementsByTagName('img')[0]) {
                            if (photos[i].getElementsByTagName('img')[0].src == Photo.src) {
                                photos[i].style.border = '3px solid #fff';
                            }
                            else
                                photos[i].style.border = '0px'; 
                        }
                        else
                            photos[i].style.border = '0px';
                    }
                } 
                else if (OpnCls == "close") {
                    for (var i = 0; i < photos.length; i++)
                        photos[i].style.border = '0px';
                }  
            }
            function isVideo() {    // подгрузка видео, если пикча в превью имеет соотв. атрибуты
                var mainElem = document.getElementsByClassName('popupElements')[0];
                var pictElem = document.getElementById('openPhoto');
                var photos = document.getElementsByClassName("photoOfList");
                var idOfVideo;
                if (pictElem.className == 'video') {
                    for (var i = 0; i < photos.length; i++)
                    {
                        if (photos[i].getElementsByTagName('img')[0].src == pictElem.src) {
                            idOfVideo = photos[i].getElementsByTagName('img')[0].id;
                            break;
                        }     
                    }
                    if (mainElem.getElementsByTagName('iframe')[0]) {
                        mainElem.getElementsByTagName('iframe')[0].remove();
                        var Video = document.getElementById(idOfVideo + (idOfVideo).substring(idOfVideo.length-1)).cloneNode();
                        Video.style.cssText = "width: 100%; height: 100%; display: block;";
                        mainElem.appendChild(Video);
                    }
                    else {
                        (mainElem.getElementsByTagName('img')[0]).style.display = 'none';
                        var Video = document.getElementById(idOfVideo + (idOfVideo).substring(idOfVideo.length-1)).cloneNode();
                        Video.style.cssText = "width: 100%; height: 100%; display: block;";
                        mainElem.appendChild(Video);
                    }
                }
                else if (pictElem.className == 'imgs'){
                    if (mainElem.getElementsByTagName('iframe')[0]) {
                        mainElem.getElementsByTagName('iframe')[0].remove();
                        pictElem.style.display = "block";
                    }
                }
            }
            
            function clickOnDots() {    //обработка собития при переключениях по точкам в превью
                var pictsList = document.getElementsByClassName("photoOfList");
                for (i = 0; i< pictsList.length; i++) {
                    // очистим от всех картинок в блоках
                    if (pictsList[i].getElementsByTagName("img")[0])
                        pictsList[i].getElementsByTagName("img")[0].remove();
                }
                for (var i = 0; i < clickedDots.length; i++) {
                    clickedDots[i].style.backgroundColor = "#ddd";
                    if (clickedDots[i].id == event.target.id)
                    {
                        choseCurrentSegment(i*4);
                        chosenPictOfList(document.getElementById("openPhoto"), "close")
                    }
                }
            }
        </script>
    </body>
</html>

