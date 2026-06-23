<?php
/**
 * Default page content (Gutenberg blocks).
 *
 * Used by the activation installer to pre-fill each page so the text is fully
 * editable in the WordPress block editor. Content is only written to a page
 * when that page is empty, so it never overwrites the church's own edits.
 *
 * @package Engrafted_Chapel
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Return the default editor content (block markup) for a given page slug.
 *
 * @param string $slug Page slug.
 * @return string Block HTML, or '' if the page has no default body content.
 */
function ec_page_default_content( $slug ) {
    switch ( $slug ) {

        case 'about':
            return <<<'HTML'
<!-- wp:heading --><h2 class="wp-block-heading">Our Story</h2><!-- /wp:heading -->
<!-- wp:paragraph --><p>Our inception happened on the 9th of September when two friends decided to become prayer partners with Rev. Clifford De-graft Ade, who graduated from Agape Bible College in 2006 and was ordained in 2008 by the Great Bishop, Bishop Dag Heward-Mills.</p><!-- /wp:paragraph -->
<!-- wp:paragraph --><p>Membership grew steadily through our prayer meetings, and on the 6th of June 2010 we held our first Sunday service with the then Odorkor Area Pastor of the Apostolic Church Ghana, Rev. Patrick Agbeveme, as our guest speaker.</p><!-- /wp:paragraph -->
<!-- wp:paragraph --><p>Since then we have grown, and continue to grow, into a scripturally, spiritually and physically healthy family where love is expressed and felt.</p><!-- /wp:paragraph -->
<!-- wp:heading --><h2 class="wp-block-heading">Our Mission</h2><!-- /wp:heading -->
<!-- wp:quote --><blockquote class="wp-block-quote"><!-- wp:paragraph --><p>To bring people to Jesus for restoration to the original God-ordained state of man through the propagation of the Good News and the development of model New Testament Christians and Churches.</p><!-- /wp:paragraph --></blockquote><!-- /wp:quote -->
<!-- wp:heading --><h2 class="wp-block-heading">Our Vision</h2><!-- /wp:heading -->
<!-- wp:list --><ul><!-- wp:list-item --><li>Serving God through our generation.</li><!-- /wp:list-item --><!-- wp:list-item --><li>Impacting society through Christ.</li><!-- /wp:list-item --><!-- wp:list-item --><li>Manifesting the Glory of our God.</li><!-- /wp:list-item --></ul><!-- /wp:list -->
<!-- wp:heading --><h2 class="wp-block-heading">Our Core Values</h2><!-- /wp:heading -->
<!-- wp:paragraph --><p>A HUMBLE person, willing to SACRIFICE will SERVE God greatly.</p><!-- /wp:paragraph -->
<!-- wp:list --><ul><!-- wp:list-item --><li><strong>Humility</strong> — we walk humbly before God and man, recognizing that all we have comes from Him.</li><!-- /wp:list-item --><!-- wp:list-item --><li><strong>Sacrifice</strong> — we are willing to give of ourselves for the sake of the Gospel.</li><!-- /wp:list-item --><!-- wp:list-item --><li><strong>Service</strong> — we serve God greatly by serving His people with love and excellence.</li><!-- /wp:list-item --></ul><!-- /wp:list -->
<!-- wp:heading --><h2 class="wp-block-heading">Our Beliefs</h2><!-- /wp:heading -->
<!-- wp:list --><ul><!-- wp:list-item --><li>The oneness of God, the unity of the Godhead and the trinity of the persons therein.</li><!-- /wp:list-item --><!-- wp:list-item --><li>The divine inspiration and authority of the Holy Scriptures.</li><!-- /wp:list-item --><!-- wp:list-item --><li>The utter depravity of human nature, the necessity for repentance and regeneration.</li><!-- /wp:list-item --><!-- wp:list-item --><li>The virgin birth, sinless nature, atoning death, triumphant resurrection, ascension and abiding intercession of the Lord Jesus Christ, and His second coming.</li><!-- /wp:list-item --><!-- wp:list-item --><li>The sacraments of baptism by immersion and the Lord's Supper.</li><!-- /wp:list-item --><!-- wp:list-item --><li>The baptism of the Holy Ghost for believers with signs and wonders.</li><!-- /wp:list-item --><!-- wp:list-item --><li>The baptism, gifts and fruits of the Holy Ghost.</li><!-- /wp:list-item --><!-- wp:list-item --><li>The justification and sanctification of the believer through the finished work of Christ.</li><!-- /wp:list-item --><!-- wp:list-item --><li>The possibility of falling from grace.</li><!-- /wp:list-item --><!-- wp:list-item --><li>Church government by Apostles, Prophets, Evangelists, Pastors, Teachers and Deacons.</li><!-- /wp:list-item --><!-- wp:list-item --><li>The obligatory nature of tithes and offerings.</li><!-- /wp:list-item --></ul><!-- /wp:list -->
<!-- wp:heading --><h2 class="wp-block-heading">The Name "Engrafted"</h2><!-- /wp:heading -->
<!-- wp:paragraph --><p>During one of our prayer sessions, the phrase "Grafting the Word" came to Rev. Ade. A study of "graff, graft and engrafted" led him to Romans 11 and James 1:21, and the revelation of "degraft and engraft" — that we need a graft only God can accomplish through His Word, the engrafted Word.</p><!-- /wp:paragraph -->
<!-- wp:paragraph --><p>With prayerful consideration he came to the conclusion that we have been "degrafted" from the world of sin and "engrafted" into Christ. This happens through the preaching and teaching of His Word — the engrafted Word, the Saving Word.</p><!-- /wp:paragraph -->
<!-- wp:heading --><h2 class="wp-block-heading">Our Pastor</h2><!-- /wp:heading -->
<!-- wp:paragraph --><p><strong>Rev. Clifford De-graft Ade</strong> &mdash; Senior Pastor and Founder</p><!-- /wp:paragraph -->
<!-- wp:paragraph --><p>Rev. Clifford De-graft Ade is a Ghanaian with Togolese heritage. Born into a large family of nine siblings, he learned early what it means to live a collective life where we depend on one another.</p><!-- /wp:paragraph -->
<!-- wp:paragraph --><p>He became a serious Christian during his secondary education and was actively involved in church work. In obedience to God's call he enrolled in Agape Bible College in 2005, graduating with an AA Degree in Bible Ministry, and remains on the move in ministry today.</p><!-- /wp:paragraph -->
HTML;

        case 'ministries':
            return <<<'HTML'
<!-- wp:paragraph --><p>There is a place for everyone in the family of Engrafted Word Chapel. Discover where you can belong, grow and serve.</p><!-- /wp:paragraph -->
<!-- wp:heading --><h2 class="wp-block-heading">Engrafted Children</h2><!-- /wp:heading -->
<!-- wp:paragraph --><p><em>Babes and sucklings</em></p><!-- /wp:paragraph -->
<!-- wp:paragraph --><p>Our children's department is an awesome place. With tutors and monitors who care for the children as their own, we instil biblical principles and values that prepare them for a life of full potential, authority and dominion as they grow into who God has destined them to become.</p><!-- /wp:paragraph -->
<!-- wp:heading --><h2 class="wp-block-heading">Engrafted Youth</h2><!-- /wp:heading -->
<!-- wp:paragraph --><p><em>Salt and Light</em></p><!-- /wp:paragraph -->
<!-- wp:paragraph --><p>The Engrafted Youth is for students looking to grow in their relationship with God and connect with a strong community of believers. Through powerful worship, anointed messages and fellowship, young people make an impact for Christ. We believe young people are not just the future of the church — they ARE the church.</p><!-- /wp:paragraph -->
<!-- wp:heading --><h2 class="wp-block-heading">Engrafted Ladies</h2><!-- /wp:heading -->
<!-- wp:paragraph --><p><em>Daughters of Sarah</em></p><!-- /wp:paragraph -->
<!-- wp:paragraph --><p>The Daughters of Sarah encourages women toward a place of wholeness and obedience in Jesus Christ, as Sarah was in the Bible. It is a place where His abundant life ministers not only to us but through us, as we grow in His grace and knowledge.</p><!-- /wp:paragraph -->
<!-- wp:heading --><h2 class="wp-block-heading">Engrafted Men</h2><!-- /wp:heading -->
<!-- wp:paragraph --><p><em>Sacrifice and Service of Faith</em></p><!-- /wp:paragraph -->
<!-- wp:paragraph --><p>As men, we are for action. We don't just talk — we act, we do. No distance is too far and no task too great. Hence our name, Sacrifice and Service of Faith (the SSF). Join us for one of our mission trips and other events!</p><!-- /wp:paragraph -->
<!-- wp:heading --><h2 class="wp-block-heading">Music Department — Word Impact Choir</h2><!-- /wp:heading -->
<!-- wp:paragraph --><p><em>Life of praise and worship</em></p><!-- /wp:paragraph -->
<!-- wp:paragraph --><p>Through testimony and song we ENCOURAGE others to make Christ the centre of their focus. Through training, weekly rehearsals and intentional discipleship we EQUIP the body to use their gifts with excellence, unity and humility. Because of who God is and what He has done, we EXALT Christ with a life of praise and worship.</p><!-- /wp:paragraph -->
HTML;

        case 'bible-college':
            return <<<'HTML'
<!-- wp:heading --><h2 class="wp-block-heading">Mission Die Theological Seminary (MDTS)</h2><!-- /wp:heading -->
<!-- wp:paragraph --><p>Is the Lord calling you into ministry? Do you want to be effective and successful as a man or woman of God? Are you confused about what the Lord is telling you to do?</p><!-- /wp:paragraph -->
<!-- wp:paragraph --><p>Mission Die Theological Seminary is a church-based Bible school affiliated with AABS (The Africa Association of Bible Schools), dedicated to training and nurturing individuals into approved ministers for the work of the Gospel.</p><!-- /wp:paragraph -->
<!-- wp:quote --><blockquote class="wp-block-quote"><!-- wp:paragraph --><p>Mission Die — where the unqualified and unapproved becomes qualified and approved, ready for the Master's use.</p><!-- /wp:paragraph --></blockquote><!-- /wp:quote -->
<!-- wp:heading --><h2 class="wp-block-heading">Programs Offered</h2><!-- /wp:heading -->
<!-- wp:paragraph --><p>We offer Certificate and Diploma courses across the core disciplines of ministry, including:</p><!-- /wp:paragraph -->
<!-- wp:list --><ul><!-- wp:list-item --><li>Christian Leadership</li><!-- /wp:list-item --><!-- wp:list-item --><li>Missiology</li><!-- /wp:list-item --><!-- wp:list-item --><li>Christian Counseling</li><!-- /wp:list-item --><!-- wp:list-item --><li>Church Administration</li><!-- /wp:list-item --><!-- wp:list-item --><li>…and other courses to equip you for fruitful service</li><!-- /wp:list-item --></ul><!-- /wp:list -->
<!-- wp:heading --><h2 class="wp-block-heading">Who Can Apply</h2><!-- /wp:heading -->
<!-- wp:paragraph --><p>The seminary welcomes anyone hungry to serve God more effectively, whether in full-time ministry or in support of the local church:</p><!-- /wp:paragraph -->
<!-- wp:list --><ul><!-- wp:list-item --><li>Full-time ministers of the Gospel</li><!-- /wp:list-item --><!-- wp:list-item --><li>Part-time and bi-vocational pastors</li><!-- /wp:list-item --><!-- wp:list-item --><li>Lay workers and church volunteers</li><!-- /wp:list-item --><!-- wp:list-item --><li>Deacons, elders and church officers</li><!-- /wp:list-item --><!-- wp:list-item --><li>Anyone seeking a deeper knowledge of the Word of God</li><!-- /wp:list-item --></ul><!-- /wp:list -->
HTML;

        case 'outreach':
            return <<<'HTML'
<!-- wp:paragraph --><p>We're called as followers of Christ to share His message of hope and love, leading others into a life-changing personal relationship with Him.</p><!-- /wp:paragraph -->
<!-- wp:heading --><h2 class="wp-block-heading">Evangelism — Easy Yoke</h2><!-- /wp:heading -->
<!-- wp:paragraph --><p>Christ calls us to share His promise of eternal love and life, both within and outside the church. Our Evangelism Ministry partners with the Mission Ministry to reach people who may not yet know that Jesus loves them and has a plan for their lives.</p><!-- /wp:paragraph -->
<!-- wp:paragraph --><p>Our core team has been trained using the "Sharing Jesus Without Fear" curriculum, and we are equipping other ministries to share their faith with confidence and grace.</p><!-- /wp:paragraph -->
<!-- wp:quote --><blockquote class="wp-block-quote"><!-- wp:paragraph --><p>We proclaim the gospel and salvation of Jesus Christ — both within and outside the church — so that those who are lost will be found.</p><!-- /wp:paragraph --></blockquote><!-- /wp:quote -->
<!-- wp:heading --><h2 class="wp-block-heading">Follow-up and Visitation — Lighter Burden</h2><!-- /wp:heading -->
<!-- wp:paragraph --><p>This department conducts intensive visitation and follow-up of newcomers and members alike. We provide care and support for recent guests and absent members, helping to integrate every newcomer into the life of the church family.</p><!-- /wp:paragraph -->
<!-- wp:paragraph --><p>We also keep careful records of converts and members so that no one slips through the cracks — every soul matters, and every person is followed up with love.</p><!-- /wp:paragraph -->
HTML;

        case 'gallery':
            return <<<'HTML'
<!-- wp:paragraph --><p>Every Sunday tells a story. Browse our photo albums to relive the worship, fellowship and special moments God has blessed us with as a church family.</p><!-- /wp:paragraph -->
HTML;

        case 'contact':
            return <<<'HTML'
<!-- wp:paragraph --><p>We would love to hear from you. Whether you have a question, a prayer request, or simply want to plan your first visit, reach out to us using any of the details below.</p><!-- /wp:paragraph -->
HTML;

        default:
            return '';
    }
}
