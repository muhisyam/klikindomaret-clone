<?php

namespace App\Services;

class PaginationService 
{
    /**
     * Change links paginate api url to current page url
     */
    public function changeLinksUrl(array $data, string $searchString) {
        $curentUrl = url()->current();
        
        foreach ($data['links'] as $key => $value) {
            $data['links'][$key]['url'] = str_replace($searchString, $curentUrl, $value['url']);
        } 

        return $data;
    }

    /**
     * Define new limit showing links page
     * 
     * @param $data['meta']
     */
    public function customPaginationLinks(array $links) {
        $customLinks = [];
        $length = count($links['links']);
        
        if ($length > 9) {
            $currentPage = $thisCurrent = $links['current_page'];
            $firstPage = 1;
            $lastPage = $thisLast = $length - 2;
            $nearFirstPage = $firstPage + 4;
            $nearLastPage = $lastPage - 4;

            // < 1 ... 8 [9] 10 ... 13 >
            if ($currentPage >= $nearFirstPage && $nearLastPage >= $currentPage) {
                $thisCurrent--;
                $thisLast--;
                for ($i=0; $i < 9; $i++) {
                    if ($i < 2) {
                        array_push($customLinks, $links['links'][$i]);
                        continue;
                    }

                    if ($i > 6) {
                        array_push($customLinks, $links['links'][$thisLast++]);
                        continue;
                    }

                    if ($i == 2 || $i == 6) {
                        $separator = [
                            'label' => 'separator'
                        ];

                        array_push($customLinks, $separator);
                        continue;
                    }

                    array_push($customLinks, $links['links'][$thisCurrent++]);
                }
            }

            // < 1 2 3 4 5 ... 10 >
            if ($currentPage < $nearFirstPage) {
                for ($i=0; $i < 9; $i++) {
                    if ($i == 6) {
                        $separator = [
                            'label' => 'separator'
                        ];

                        array_push($customLinks, $separator);
                        continue;
                    }

                    if ($i == 7) {
                        array_push($customLinks, $links['links'][$lastPage]);
                        continue;
                    }

                    if ($i == 8) {
                        array_push($customLinks, $links['links'][$length - 1]);
                        continue;
                    }

                    array_push($customLinks, $links['links'][$i]);
                }
            }

            // < 1 ... 6 7 [8] 9 10 >
            if ($currentPage > $nearLastPage) {

                for ($i=0; $i < 9; $i++) {
                    if ($i < 2) {
                        array_push($customLinks, $links['links'][$i]);
                        continue;
                    }

                    if ($i == 2) {
                        $separator = [
                            'label' => 'separator'
                        ];

                        array_push($customLinks, $separator);
                        continue;
                    }

                    array_push($customLinks, $links['links'][$nearLastPage++]);
                }
            }

            return $customLinks;
        }
            
        return $links['links'];
    }
}