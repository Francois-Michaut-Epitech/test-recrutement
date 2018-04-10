<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require 'src/Breadcrumb.php';

final class breadcrumbTest extends TestCase
{
    public function testBreadcrumb(): void
    {
        $menu = [
            [
                'name' => '1',
                'child' => [
                    [
                        'name' => '1.1',
                        'child' => [],
                    ],
                    [
                        'name' => '1.2',
                        'child' => [
                            [
                                'name' => '1.2.1',
                                'child' => [
                                    [
                                        'name' => '1.2.1.1',
                                        'child' => [
                                            [
                                                'name' => '1.2.1.1.1',
                                                'child' => [],
                                            ],
                                            [
                                                'name' => '1.2.1.1.2',
                                                'child' => [
                                                    [
                                                        'name' => '1.2.1.1.2.1',
                                                        'child' => [],
                                                    ],
                                                    [
                                                        'name' => '1.2.1.1.2.2',
                                                        'child' => [],
                                                    ],
                                                    [
                                                        'name' => '1.2.1.1.2.3',
                                                        'child' => [],
                                                    ],
                                                ],
                                            ],
                                            [
                                                'name' => '1.2.1.1.3',
                                                'child' => [],
                                            ],
                                        ],
                                    ],
                                    [
                                        'name' => '1.2.1.2',
                                        'child' => [],
                                    ],
                                    [
                                        'name' => '1.2.1.3',
                                        'child' => [],
                                    ],
                                ],
                            ],
                            [
                                'name' => '1.2.2',
                                'child' => [],
                            ],
                            [
                                'name' => '1.2.3',
                                'child' => [],
                            ],
                        ],
                    ],
                    [
                        'name' => '1.3',
                        'child' => [],
                    ],
                ]
            ],
            [
                'name' => '2',
                'child' => [
                    [
                        'name' => '2.1',
                        'child' => [
                            [
                                'name' => '2.1.1',
                                'child' => [],
                            ],
                            [
                                'name' => '2.1.2',
                                'child' => [],
                            ],
                            [
                                'name' => '2.1.3',
                                'child' => [],
                            ],
                            [
                                'name' => '2.1.4',
                                'child' => [],
                            ],
                        ],
                    ],
                    [
                        'name' => '2.2',
                        'child' => [
                            [
                                'name' => '2.2.1',
                                'child' => [],
                            ],
                            [
                                'name' => '2.2.2',
                                'child' => [],
                            ]
                        ],
                    ],
                    [
                        'name' => '2.3',
                        'child' => [
                            [
                                'name' => '2.3.1',
                                'child' => [],
                            ]
                        ],
                    ],
                ],
            ],
            [
                'name' => '3',
                'child' => [
                    [
                        'name' => '3.1',
                        'child' => [],
                    ],
                    [
                        'name' => '3.2',
                        'child' => [],
                    ],
                    [
                        'name' => '3.3',
                        'child' => [],
                    ],
                ],
            ],
        ];

        $breadcrumb = new Breadcrumb();
        $breadcrumb->setMenu($menu);

        $this->assertEquals(
            $breadcrumb->getBreadcrumb('3.1'),
            ['3', '3.1']
        );

        $this->assertEquals(
            $breadcrumb->getBreadcrumb('1.2.1.1.2.3'),
            ['1', '1.2', '1.2.1', '1.2.1.1', '1.2.1.1.2', '1.2.1.1.2.3']
        );

        $this->assertEquals(
            $breadcrumb->getBreadcrumb('1.2.1.3'),
            ['1', '1.2', '1.2.1', '1.2.1.3']
        );

        $this->assertEquals(
            $breadcrumb->getBreadcrumb('2.3.1'),
            ['2', '2.3', '2.3.1']
        );
    }

    public function testBreadcrumbRealArbo(): void
    {
        $menu = [
            [
                'name' => 'Home',
                'child' => [
                    [
                        'name' => 'Contact',
                        'child' => [],
                    ],
                    [
                        'name' => 'Account',
                        'child' => [
                            [
                                'name' => 'Edit account',
                                'child' => [],
                            ],
                            [
                                'name' => 'Edit password',
                                'child' => [],
                            ],
                            [
                                'name' => 'Logout',
                                'child' => [],
                            ],
                        ],
                    ],
                    [
                        'name' => 'Order',
                        'valid' => false,
                        'child' => [
                            [
                                'name' => 'New order',
                                'child' => [],
                            ],
                            [
                                'name' => 'My order',
                                'child' => [
                                    [
                                        'name' => 'Order detail',
                                        'child' => [],
                                    ],
                                    [
                                        'name' => 'Delete order',
                                        'child' => [],
                                    ],
                                ],
                            ],
                        ],
                    ],
                    [
                        'name' => 'Order',
                        'valid' => false,
                        'child' => [
                            [
                                'name' => 'New order',
                                'child' => [],
                            ],
                            [
                                'name' => 'My order',
                                'child' => [
                                    [
                                        'name' => 'Order detail',
                                        'child' => [
                                            [
                                                'name' => 'Bills',
                                                'child' => [
                                                    [
                                                        'name' => 'Download bills',
                                                        'child' => [],
                                                    ],
                                                ],
                                            ],
                                            [
                                                'name' => 'Purchase order',
                                                'child' => [
                                                    [
                                                        'name' => 'Download purchase order',
                                                        'child' => [],
                                                    ],
                                                ],
                                            ],
                                        ],
                                    ],
                                    [
                                        'name' => 'Delete order',
                                        'child' => [],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];

        $breadcrumb = new Breadcrumb();
        $breadcrumb->setMenu($menu);

        $this->assertEquals(
            $breadcrumb->getBreadcrumb('Download purchase order'),
            [
                'Home',
                'Order',
                'My order',
                'Order detail',
                'Purchase order',
                'Download purchase order'
            ]
        );

	$this->assertEquals(
            $breadcrumb->getBreadcrumb('Home'),
            [
                'Home'
            ]
        );

        $this->assertEquals(
            $breadcrumb->getBreadcrumb('Delete order'),
            [
                'Home',
                'Order',
                'My order',
                'Delete order',
            ]
        );

        $this->assertEquals(
            $breadcrumb->getBreadcrumb('Order detail'),
            [
                'Home',
                'Order',
                'My order',
                'Order detail',
            ]
        );

        $this->assertEquals(
            $breadcrumb->getBreadcrumb('Account'),
            [
                'Home',
                'Account',
            ]
        );
    }
}
