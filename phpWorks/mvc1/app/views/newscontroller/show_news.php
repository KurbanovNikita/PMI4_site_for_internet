
<div class="news_container">
    <div class="news_title"><?=$this->news["title"]?></div>
    <div class="news_data"><?=substr($this->news["date"],0,-9)?></div>
    <div class="news_d_img"><?= strlen($this->news["d_img"]) > 0 ? "<img src='" . MAIN_PREFIX . "/upload/{$this->news["d_img"]}' width='100px'/>" : "" ?></div>
    <div class="main_text"><? echo htmlspecialchars_decode($this->news["text"])?></div>
    <br/>
    
    <div class="main_block_comments">
    <?if (is_array($this->comments) && count($this->comments) > 0) :?>
    
        <p style="font-size: 36px; font-weight: 700;">Комментарии<p>
        <div class="comments">
            <?foreach ($this->comments as $comm):?>
                <div class="commentarie">
                    <div class="cont_com">
                        <div >
                            <div class="comm_name col-1"><?=$comm["name"]?></div> 
                            <div class="com_data"><?=$comm["data"]?></div>
                        </div>
                        
                        <div class="com_text col-9"><?=$comm["text"]?></div>
                        <?if (Libs\User::isLogin() && (Libs\User::isAdmin() || Libs\User::getID() == $comm["user_id"])):?>
                            <button onclick="commentDelete(<?= $comm["id"] ?>)" >Удалить</button>
                        <?endif;?>
                    </div>
                </div>
            <? endforeach;?>
        </div>
   
    <?endif;?>
    <?if (Libs\User::isLogin()):?>
        <div class="new_comment">
            <form id="new_commentaries" method="post" >
                <div class="form-group">
                    <label for="section_name">Комментарий</label>
                    <input type="text" required class="form-control" name="comm_text" id="comm_text" placeholder="">
                </div>
                <div class="modal-footer">
                    
                    <button type="submit" class="btn btn-primary" id="add_new_section" onclick="add_new_comment(<?= Libs\User::getID()?>,<?=$this->news["id"]?>)">Добавить </button>
                </div>
            </form>
        </div>
    <?endif;?>
    </div>
    <br/>
</div>