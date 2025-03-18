<?php

/**
 * This file is part of the package magicsunday/webtrees-fan-chart.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace MagicSunday\Webtrees\FanChart\Model;

use JsonSerializable;

/**
 * This class holds information about a node.
 *
 * @author  Rico Sonntag <mail@ricosonntag.de>
 * @license https://opensource.org/licenses/GPL-3.0 GNU General Public License v3.0
 * @link    https://github.com/magicsunday/webtrees-fan-chart/
 */
class Node implements JsonSerializable
{
    /**
     * @var NodeData
     */
    protected NodeData $data;
	
    /**
     * The list of children.
     *
     * @var Node[]
     */
    protected array $children = [];

    /**
     * The list of parents.
     *
     * @var Node[]
     */
    protected array $parents = [];

    /**
     * The list of partners.
     *
     * @var Node[]
     */
    protected array $partners = [];

	/**
     * Constructor.
     *
     * @param NodeData $data
     */
    public function __construct(NodeData $data)
    {
        $this->data = $data;
    }

    /**
     * @return NodeData
     */
    public function getData(): NodeData
    {
        return $this->data;
    }

    /**
     * @return Node[]
     */
    public function getChildren(): array
    {
        return $this->children;
    }

    /**
     * @param Node[] $children
     *
     * @return Node
     */
    public function setChildren(array $children): Node
    {
        $this->children = $children;

        return $this;
    }

	/**
     * @param Node $partner
     *
     * @return Node
     */
    public function setPartner(node $partner): Node
    {
        $this->partners[] = $partner;

        return $this;
    }

    /**
     * @param Node $parent
     *
     * @return Node
     */
    public function addParent(Node $parent): Node
    {
        $this->parents[] = $parent;

        return $this;
    }

    /**
     * Returns the relevant data as an array.
     *
     * @return array<string, int|int[]|NodeData|Node[]>
     */
    public function jsonSerialize(): array
    {
        $jsonData = [
            'data' => $this->data,
        ];

        if ($this->parents !== []) {
            $jsonData['parents'] = $this->parents;
        }

        if ($this->partners !== []) {
            $jsonData['partners'] = $this->partners;
        }

        if ($this->children !== []) {
            $jsonData['children'] = $this->children;
        }

        return $jsonData;
    }
}
