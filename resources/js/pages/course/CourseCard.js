import React from "react";

const CourseCard = ({benrolement, goCourse=false, data, changeActiveBatch}) => {
    // console.log(benrolement);
    const courseUrl = "/batch/" + goCourse === true ? benrolement.batch.slug : benrolement.slug;
    const course = goCourse ? benrolement.course : benrolement;

    return <div className={`single-course bshadow bradius-15 mb-4 c-point p-4 ${ data.active_batch?.batch_id == benrolement.batch_id ? "bg-purple-light-50" : ""}`} onClick={()=>changeActiveBatch(benrolement)}>
        <div className="row">
            <div className="col-lg-4">
                {course.icon ?
                    <img src={ course.icon} className="rounded-circle img-fluid" alt="course" />
                    :
                    <img src="/student/public/images/paths/mailchimp_430x168.png" className=" rounded-circle img-fluid" alt="course" />
                }
            </div>
            <div className="col-lg-8">
                <h4 className="text-xsm text-black fw-600 mb-2">{course.title}</h4>
                {goCourse ? <h5 className="text-xxsm text-black fw-600 mb-3">Batch: {benrolement.batch.title}</h5> : ''}
                <div className="row text-gray text-xxxsm">
                    <div className="col-6 pr-0">
                        <div className="mb-3">
                            <i className="fas fa-book-open"></i> 24 Lesson
                        </div>
                        <div>
                            <i className="fas fa-file-alt"></i> 6 Assignments
                        </div>
                    </div>
                    <div className="col-6 pr-0">
                        <div className="mb-3">
                            <i className="far fa-clock"></i> {course.duration} Months
                        </div>
                        <div>
                            <i className="fas fa-user-friends"></i> 312 Students
                        </div>
                    </div>
                </div>
                <a href={courseUrl} className="btn d-inline-block mt-4 fw-800 text-xxsm btn-outline text-purple px-4">{goCourse ? "Go to course" : "Enroll this course"}</a>
            </div>
        </div>
</div>;
    

}

export default CourseCard;