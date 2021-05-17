<?php


namespace blogapp\Views;


class IndexView extends View
{
    const INDEX_VUE = 1;

    public function render() {
        $content = $this->displayPosts();

        return $this->userPage($content);
    }

    public function displayPosts() {
        $res = "";

        if ($this->source != null) {

            foreach ($this->source as $post) {
                $url = $this->cont->router->pathFor('billet_aff', ['id' => $post->id]);
//                $usr = $post->
                $res .= <<<YOP
    <div class="card p-3" style="height: 23rem;">
        <div class="row card-body d-flex">
            <h3 class="card-title">$post->titre</h5>
                <div class="card-info d-flex" style="margin-bottom: 1rem;">
                    <div class="card-info-sub">
                        <i class="far fa-user"></i> John Doe
                    </div>
                    <div class="card-info-sub">
                        <i class="far fa-calendar-alt"></i> 17 Mai 2021
                    </div>
                    <div class="card-info-sub">
                        <i class="far fa-comments"></i> 8 comments
                    </div>
                </div>
            <div class="col">
                <img src="./wood_table.jpg" class="card-img-top" alt="...">
            </div>
            <div class="col-lg-8">
                <div class="row" style="height: 80%;">
                    <p class="card-text m-8">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur sodales metus vel urna iaculis, in varius ligula viverra. Suspendisse rhoncus, odio id vulputate dapibus, ante ex posuere metus, eu mollis lorem erat in nulla. In finibus massa purus, nec molestie neque mattis laoreet. Proin a proin...</p>
                </div>
                <div class="row justify-content-end">
                    <a href="#" class="btn btn-primary bg-dark" style="width: auto;">See more</a>
                </div>
            </div>
        </div>
    </div>
YOP;

            }
        }
        else
            $res = "<h1>Erreur : la liste de billets n'existe pas !</h1>";

        return $res;

    }
}