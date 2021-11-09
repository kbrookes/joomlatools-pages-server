---
title: Authors
@route: /authors
@collection:
    model: ext:storyblok.model.authors
layout: /default
---

<h1>Authors</h1>
<div class="container mx-auto">
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-12">
    <?  foreach(collection() as $item):?>
        <div class="overflow-hidden shadow-lg rounded-lg h-90 w-60 md:w-80 cursor-pointer m-auto">
            <div class="bg-white rounded-lg p-6">
                <div class="flex items-center space-x-6 mb-4">
                    <img class="h-28 w-28 object-cover object-center rounded-full" 
                    src="<?= $item->image['filename']; ?>" alt="<?= $item->name; ?> headshot">
                    <div>
                        <p class="text-xl text-gray-700 font-normal mb-1"><?= $item->name; ?></p>
                        <p class="text-base text-blue-600 font-normal"><?= $item->role; ?></p>
                    </div>
                </div>
                <div>
                    <p class="text-gray-400 leading-loose font-normal text-base"></p>
                    <? 
                    $bio = $item->bio;
                    if(is_array($bio)){
                        $bio = $item->bio['content'];
                        foreach($bio as $content){
                            $paras = $content['content'];
                            foreach($paras as $para){
                                echo '<p>' . $para['text'] . '</p>';
                            }
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    <? endforeach; ?>
    </div>
    <?= helper('paginator.pagination') ?>

</div>