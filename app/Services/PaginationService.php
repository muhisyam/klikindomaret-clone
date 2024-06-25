<?php

namespace App\Services;

class PaginationService 
{
    protected $newLinks = [];

    // MARK: Change links url.
    /**
     * Change links paginate api url to route page url.
     * 
     * @param array  $response
     * @param string $apiEndpoint
     * @param string $routeName
     */
    public function changeLinksUrl(array $response, string $apiEndpoint, string $replacedUrl): array
    {
        foreach ($response['links'] as $key => $link) {
            $response['links'][$key]['url'] = str_replace(rtrim($apiEndpoint, '/'), $replacedUrl, $link['url']);
        }

        return $response;
    }

    // MARK: Custom pagination links.
    /**
     * Define new limit showing links page
     * 
     * @param array $response['meta']
     */
    public function customPaginationLinks(array $links): array
    {
        $length = count($links['links']);
        
        if ($length > 9) {
            $currentPage   = $links['current_page'];
            $firstPage     = 1;
            $lastPage      = $length - 2;
            $nearFirstPage = $firstPage + 4;
            $nearLastPage  = $lastPage - 4;

            // < 1 ... 8 [9] 10 ... 13 >
            if ($currentPage >= $nearFirstPage && $nearLastPage >= $currentPage) {
                // -1 for number in array index
                $thisCurrent = $currentPage - 1;

                // -2 because it start with arrow and first page,
                $thisLast = $length - 2;

                for ($i=0; $i < 9; $i++) {
                    if ($i < 2) {
                        $this->addNewLinks($links['links'][$i]);
                    } elseif ($i > 6) {
                        $this->addNewLinks($links['links'][$thisLast++]);
                    } elseif ($i == 2 || $i == 6) {
                        $this->addSeparator();
                    } else {
                        $this->addNewLinks($links['links'][$thisCurrent++]);
                    }
                }
            }

            // < 1 2 [3] 4 5 ... 10 >
            if ($currentPage < $nearFirstPage) {
                for ($i=0; $i < 9; $i++) {
                    if ($i == 6) {
                        $this->addSeparator();
                    } elseif ($i == 7) {
                        $this->addNewLinks($links['links'][$lastPage]);
                    } elseif ($i == 8) {
                        $this->addNewLinks($links['links'][$length - 1]);
                    } else {
                        $this->addNewLinks($links['links'][$i]);
                    }
                }
            }

            // < 1 ... 6 7 [8] 9 10 >
            if ($currentPage > $nearLastPage) {
                for ($i=0; $i < 9; $i++) {
                    if ($i < 2) {
                        $this->addNewLinks($links['links'][$i]);
                    } elseif ($i == 2) {
                        $this->addSeparator();
                    } else {
                        $this->addNewLinks($links['links'][$nearLastPage++]);
                    }
                }
            }
        } else {
            for ($i = 0; $i < $length; $i++) { 
                $this->addNewLinks($links['links'][$i]);
            }
        }
            
        return $this->newLinks;
    }

    // MARK: Add new links.
    /**
     * Add new link page key and push data link to new array.
     * 
     * @param array $link
    */
    private function addNewLinks(array $link): int
    {
        $queryUrl = parse_url($link['url'], PHP_URL_QUERY);
        parse_str($queryUrl, $queryParams);
        $linkPage     = isset($queryParams['page']) ? $queryParams['page'] : null;
        $link['page'] = $linkPage;

        return array_push($this->newLinks, $link);
    }

    // MARK: Add separator.
    /**
     * Add separator among link page.
    */
    private function addSeparator(): int
    {
        return array_push($this->newLinks, [
            'label' => 'separator'
        ]);
    }
}