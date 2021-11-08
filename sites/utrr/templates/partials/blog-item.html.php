---
category: none
title: none
intro: none
image: none
video: none
---
<?
$thumb = null;
if(!empty($video)){
    $thumb = 'https://i.ytimg.com/vi/' .$video . '/hqdefault.jpg';
} elseif(empty($video) && $image != 'none'){
    $thumb = $image;
} ?>

<div class="overflow-hidden shadow-lg rounded-lg h-90 w-60 md:w-80 cursor-pointer m-auto">
    <a href="#" class="w-full block h-full">
        <? if(!empty($thumb)){?>
        <img alt="blog photo" src="<?= $thumb; ?>" class="max-h-40 w-full object-cover"/>
        <? } ?>
        <div class="bg-white dark:bg-gray-800 w-full p-4">
            <p class="text-indigo-500 text-md font-medium">
                <?= $category; ?>
            </p>
            <p class="text-gray-800 dark:text-white text-xl font-medium mb-2">
                <?= $title; ?>
            </p>
            <p class="text-gray-400 dark:text-gray-300 font-light text-md">
                <?= $intro; ?>
            </p>
            <div class="flex items-center mt-4">
                <a href="#" class="block relative">
                    <img alt="profil" src="/images/person/6.jpg" class="mx-auto object-cover rounded-full h-10 w-10 "/>
                </a>
                <div class="flex flex-col justify-between ml-4 text-sm">
                    <p class="text-gray-800 dark:text-white">
                        Jean Jacques
                    </p>
                    <p class="text-gray-400 dark:text-gray-300">
                        20 mars 2029 - 6 min read
                    </p>
                </div>
            </div>
        </div>
    </a>
</div>
