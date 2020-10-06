<!-- ======= Jobs Section ======= -->
<section id="jobs" class="jobs section-bg">
    <div class="container">

        <div class="section-title" data-aos="fade-up">
            <h2>加入我们</h2>
            <p></p>
        </div>

        <?php
        assert(isset($jobs));
        foreach ($jobs as $key => &$job) {
            $job['Job']['jobId'] = "job-" . $key;
        }

        $groupedJobs = array();
        foreach ($jobs as $key => $job) {
            $groupedJobs[$job['Job']['category']][$key] = $job['Job'];
        }
        ?>

        <div class="row h-75">
            <div class="col-3 h-100 overflow-auto">
                <div class="list-group" id="list-tab" role="tablist">
                    <?php
                    $jobId = 0;
                    foreach ($groupedJobs as $category => $jobList):
                        ?>
                        <a class="btn disabled">
                            <?php echo $groupedJobs[$category][$jobId]['categoryDisplay'] ?>
                        </a>
                        <?php
                        $j = 0;
                        foreach ($jobList as $job):
                            ++$jobId;
                            ++$j;
                            ?>
                            <a id="<?php echo "list-" . $job['jobId'] . "-list" ?>"
                               class="list-group-item list-group-item-action"
                               data-toggle="list"
                               role="tab"
                               aria-controls="<?php echo $job['jobId'] ?>"
                               href="#<?php echo $job['jobId'] ?>"
                            >
                                <?php echo $job['title'] ?>
                            </a>
                        <?php endforeach; ?>
                    <?php endforeach ?>
                </div>
            </div>

            <div class="col-9">
                <div class="tab-content" id="nav-tabContent">
                    <?php
                    $i = 0;
                    foreach ($jobs as $job):
                    if (!isset($job['Job'])) continue;
                    $job = $job['Job'];
                    ++$i;
                    ?>
                        <div id="<?php echo "list-" . $job['jobId'] ?>"
                             class="tab-pane fade <?php if ($i == 1) echo "show active" ?>"
                             role="tabpanel"
                             aria-labelledby="<?php echo "list-" . $job['jobId'] . "-list" ?>">
                            <div class="align-items-stretch my-4">
                                <div class="member">
                                    <div class="text-left member-info">
                                        <div class="join-us__content-item">
                                            <div class="card card-header"><?php echo $job['title'] ?></div>
                                            <div class="card card-body">
                                                <p class="inner-address">
                                                <p>
                                                    岗位职责：
                                                </p>
                                                <div class="join-us__content-item-jd">
                                                    <?php echo $job['duty'] ?>
                                                </div>
                                                <p class="mt-5">
                                                    任职要求：
                                                </p>
                                                <div class="join-us__content-item-jd">
                                                    <?php echo $job['condition'] ?>
                                                </div>
                                                <a class="mt-3" href="mailto:galaxyeye@live.cn">投递简历</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>

        </div>

    </div>
</section><!-- End Team Section -->
