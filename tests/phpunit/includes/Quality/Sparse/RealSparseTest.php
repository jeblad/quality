<?php

namespace Quality\Test;

use Quality\Sparse\RealSparse;
use Quality\Transform\IdentityTransform;
use Quality\Transform\Log1pTransform;

/**
 * Test Quality\Sparse\Sparse.
 *
 * @file
 * @since 0.1
 *
 * @ingroup QualityTest
 * @ingroup Test
 *
 * @group Database
 * @group Quality
 * @group QualityFeature
 *
 * @licence GNU GPL v2+
 * @author John Erling Blad < jeblad@gmail.com >
 *
 */
class RealSparseTest extends SparseTest {

	public function setUp() {
		parent::setUp();
		$this->className = 'Quality\Sparse\RealSparse';
	}

	public static function provideData() {
		return array(
			array(
				array(),
				-0.5, // outside defined sparse vector
				array( false, false ),
			),
			array(
				array(),
				-0.4999,
				array( true, false ),
			),
			array(
				array(),
				0.4999,
				array( true, false ),
			),
			array(
				array(),
				0.5,
				array( false, true ),
			),
			array(
				array(),
				1.4999,
				array( false, true ),
			),
			array(
				array(),
				1.5, // outside defined sparse vector
				array( false, false ),
			),
			array(
				array( 'bins' => 5, 'min' => 1, 'max' => 3 ),
				0.750000, // outside defined sparse vector
				array( false, false, false, false, false ),
			),
			array(
				array( 'bins' => 5, 'min' => 1, 'max' => 3 ),
				0.750001,
				array( true, false, false, false, false ),
			),
			array(
				array( 'bins' => 5, 'min' => 1, 'max' => 3 ),
				3.249999,
				array( false, false, false, false, true ),
			),
			array(
				array( 'bins' => 5, 'min' => 1, 'max' => 3 ),
				3.25, // outside defined sparse vector
				array( false, false, false, false, false ),
			),
			array(
				array( 'func' => new IdentityTransform() ),
				-0.5, // outside defined sparse vector
				array( false, false ),
			),
			array(
				array( 'func' => new IdentityTransform() ),
				-0.4999,
				array( true, false ),
			),
			array(
				array( 'func' => new IdentityTransform() ),
				0.4999,
				array( true, false ),
			),
			array(
				array( 'func' => new IdentityTransform() ),
				0.5,
				array( false, true ),
			),
			array(
				array( 'func' => new IdentityTransform() ),
				1.4999,
				array( false, true ),
			),
			array(
				array( 'func' => new IdentityTransform() ),
				1.5, // outside defined sparse vector
				array( false, false ),
			),
			array(
				array(
					'func' => new IdentityTransform(),
					'bins' => 5, 'min' => 1, 'max' => 3
				),
				0.750000, // outside defined sparse vector
				array( false, false, false, false, false ),
			),
			array(
				array(
					'func' => new IdentityTransform(),
					'bins' => 5, 'min' => 1, 'max' => 3
				),
				0.750001,
				array( true, false, false, false, false ),
			),
			array(
				array(
					'func' => new IdentityTransform(),
					'bins' => 5, 'min' => 1, 'max' => 3
				),
				3.249999,
				array( false, false, false, false, true ),
			),
			array(
				array(
					'func' => new IdentityTransform(),
					'bins' => 5, 'min' => 1, 'max' => 3
				),
				3.25, // outside defined sparse vector
				array( false, false, false, false, false ),
			),

			array(
				array( 'func' => new Log1pTransform() ),
				0,
				array( true, false ),
			),
			array(
				array( 'func' => new Log1pTransform() ),
				0.25,
				array( true, false ),
			),
			array(
				array( 'func' => new Log1pTransform() ),
				0.75,
				array( false, true ),
			),
			array(
				array( 'func' => new Log1pTransform() ),
				1,
				array( false, true ),
			),
			array(
				array( 'func' => new Log1pTransform() ),
				4, // outside defined sparse vector
				array( false, false ),
			),
			array(
				array(
					'func' => new Log1pTransform(),
					'bins' => 10, 'min' => 0, 'max' => 3
				),
				0,
				array( true, false, false, false, false, false, false, false, false, false ),
			),
			array(
				array(
					'func' => new Log1pTransform(),
					'bins' => 10, 'min' => 0, 'max' => 3
				),
				0.2,
				array( false, true, false, false, false, false, false, false, false, false ),
			),
			array(
				array(
					'func' => new Log1pTransform(),
					'bins' => 10, 'min' => 0, 'max' => 3
				),
				0.4, // outside defined sparse vector
				array( false, false, true, false, false, false, false, false, false, false ),
			),
			array(
				array(
					'func' => new Log1pTransform(),
					'bins' => 10, 'min' => 0, 'max' => 3
				),
				0.6, // outside defined sparse vector
				array( false, false, false, true, false, false, false, false, false, false ),
			),
			array(
				array(
					'func' => new Log1pTransform(),
					'bins' => 10, 'min' => 0, 'max' => 3
				),
				0.8, // outside defined sparse vector
				array( false, false, false, false, true, false, false, false, false, false ),
			),
			array(
				array(
					'func' => new Log1pTransform(),
					'bins' => 10, 'min' => 0, 'max' => 3
				),
				1,
				array( false, false, false, false, false, true, false, false, false, false ),
			),
			array(
				array(
					'func' => new Log1pTransform(),
					'bins' => 10, 'min' => 0, 'max' => 3
				),
				1.2,
				array( false, false, false, false, false, true, false, false, false, false ),
			),
			array(
				array(
					'func' => new Log1pTransform(),
					'bins' => 10, 'min' => 0, 'max' => 3
				),
				1.4,
				array( false, false, false, false, false, false, true, false, false, false ),
			),
			array(
				array(
					'func' => new Log1pTransform(),
					'bins' => 10, 'min' => 0, 'max' => 3
				),
				1.6,
				array( false, false, false, false, false, false, true, false, false, false ),
			),
			array(
				array(
					'func' => new Log1pTransform(),
					'bins' => 10, 'min' => 0, 'max' => 3
				),
				1.8,
				array( false, false, false, false, false, false, false, true, false, false ),
			),
			array(
				array(
					'func' => new Log1pTransform(),
					'bins' => 10, 'min' => 0, 'max' => 3
				),
				2.0,
				array( false, false, false, false, false, false, false, true, false, false ),
			),
			array(
				array(
					'func' => new Log1pTransform(),
					'bins' => 10, 'min' => 0, 'max' => 3
				),
				2.2,
				array( false, false, false, false, false, false, false, false, true, false ),
			),
			array(
				array(
					'func' => new Log1pTransform(),
					'bins' => 10, 'min' => 0, 'max' => 3
				),
				2.4,
				array( false, false, false, false, false, false, false, false, true, false ),
			),
			array(
				array(
					'func' => new Log1pTransform(),
					'bins' => 10, 'min' => 0, 'max' => 3
				),
				2.6,
				array( false, false, false, false, false, false, false, false, true, false ),
			),
			array(
				array(
					'func' => new Log1pTransform(),
					'bins' => 10, 'min' => 0, 'max' => 3
				),
				2.8,
				array( false, false, false, false, false, false, false, false, false, true ),
			),
			array(
				array(
					'func' => new Log1pTransform(),
					'bins' => 10, 'min' => 0, 'max' => 3
				),
				3,
				array( false, false, false, false, false, false, false, false, false, true ),
			),
			array(
				array(
					'func' => new Log1pTransform(),
					'bins' => 10, 'min' => 0, 'max' => 3
				),
				3.2,
				array( false, false, false, false, false, false, false, false, false, true ),
			),
			array(
				array(
					'func' => new Log1pTransform(),
					'bins' => 10, 'min' => 0, 'max' => 3
				),
				3.4,
				array( false, false, false, false, false, false, false, false, false, false ),
			),
		);
	}
}
