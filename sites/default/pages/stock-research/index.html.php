---
title: Stock Research
@route: /stock-research
@collection:
    model: ext:storyblok.model.companies
layout: /default
---
<h1>Storyblok Data</h1>
<p>This is just simple example of a collection that pulls data from the Storyblok API, using the storyblok model to also connect some data from the Airtable model.</p>
<p>It shows how collections work in Pages, as well as how routes work within collections.</p>
<!-- This example requires Tailwind CSS v2.0+ -->
<div class="flex flex-col">
  <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
      <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Name
              </th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Code
              </th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Sector
              </th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Market Cap
              </th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Return
              </th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Recommendations
              </th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
          <?  foreach(collection() as $item):?>
            <tr>
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="text-sm -text-gray-900 font-bold underline"><a href="<?= route(page('/stock-research/article'), ['slug' => $item->slug]) ?>"><?= $item->Name; ?></a></span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900"><?= $item->Code; ?></div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900"><?= $item->Sector; ?></div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                <div class="text-sm text-gray-900"><?= $item->record->Market_Cap; ?></div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                <div class="text-sm text-gray-900"><?= $item->record->Return; ?></div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                <div class="text-sm text-gray-900"><?= $item->record->Company_Rating; ?></div>
              </td>
            </tr>
        <? endforeach; ?>
            <!-- More people... -->
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>